<?php
require_once __DIR__ . '/../../config.php';
require BASE_PATH . '/sistema/conexao.php';

class Endereco
{
    private $AZURE_KEY = "2SYa7kSFzobsWruraSw2t8ukHXQUqvQ9yMTAU94LFshgcffEy971JQQJ99BKACYeBjF308ZQAAAgAZMP1MpJ";

    // ------------------------------
    // MÉTODO BASE PARA REQUESTS
    // ------------------------------
    private function request($url)
    {
        $json = @file_get_contents($url);

        if ($json === false) {
            return false;
        }

        return json_decode($json, true);
    }

    // ------------------------------
    // GEOCODIFICAÇÃO COMPLETA
    // ------------------------------
    public function geocodificarAzure($endereco, $azKey)
    {
        $url = "https://atlas.microsoft.com/search/address/json?"
            . "api-version=1.0"
            . "&subscription-key={$azKey}"
            . "&query=" . urlencode($endereco);

        $data = $this->request($url);

        if (!$data || !isset($data["results"][0])) {
            return false;
        }

        return [
            'lat' => $data["results"][0]["position"]["lat"] ?? null,
            'lon' => $data["results"][0]["position"]["lon"] ?? null
        ];
    }

    // ------------------------------
    // SOMENTE LATITUDE
    // ------------------------------
    public function geocodificarLatAzure($endereco, $azKey)
    {
        $geo = $this->geocodificarAzure($endereco, $azKey);
        return $geo ? $geo['lat'] : false;
    }

    // ------------------------------
    // SOMENTE LONGITUDE
    // ------------------------------
    public function geocodificarLonAzure($endereco, $azKey)
    {
        $geo = $this->geocodificarAzure($endereco, $azKey);
        return $geo ? $geo['lon'] : false;
    }

    // ------------------------------
    // DISTÂNCIA POR ROTA (METROS)
    // ------------------------------
    public function distanciaRotaAzure($latOrig, $lonOrig, $latDest, $lonDest, $azKey)
    {
        // Evita chamadas inválidas
        if ($latOrig === null || $lonOrig === null || $latDest === null || $lonDest === null) {
            return false;
        }

        // Evita origem = destino (API retorna 400)
        if ($latOrig == $latDest && $lonOrig == $lonDest) {
            return 0;
        }

        // Formato correto + urlencode
        $coord = urlencode("{$lonOrig},{$latOrig}:{$lonDest},{$latDest}");

        $url = "https://atlas.microsoft.com/route/directions/json?"
            . "api-version=1.0"
            . "&subscription-key={$azKey}"
            . "&query={$coord}"
            . "&travelMode=car";

        $data = $this->request($url);

        if (!$data || !isset($data["routes"][0]["summary"]["lengthInMeters"])) {
            return false;
        }

        return $data["routes"][0]["summary"]["lengthInMeters"];
    }

    // ------------------------------
    // CÁLCULO FINAL DE QUADRAS PRÓXIMAS
    // ------------------------------
    public function calcularQuadrasProximas($qnt_quadras)
    {
        require BASE_PATH . '/sistema/conexao.php';

        // Buscar o usuário
        $sql = "SELECT * FROM usuario WHERE cod_usuario = :cod_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cod_usuario', $_SESSION['cod_usuario']);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            die("Erro: usuário não encontrado.");
        }

        // Montar endereço de origem
        $endereco_orig =
            ($usuario['rua'] ?? '') . ', ' .
            ($usuario['bairro'] ?? '') . ', ' .
            ($usuario['cidade'] ?? '') . ', Brasil';

        // Geocodificar origem
        $coord_orig = $this->geocodificarAzure($endereco_orig, $this->AZURE_KEY);

        if (!$coord_orig) {
            die("Não foi possível geocodificar o endereço do Usuário.");
        }

        $lat_orig = $coord_orig["lat"];
        $lon_orig = $coord_orig["lon"];

        // Buscar quadras
        $stmt = $pdo->query("SELECT DISTINCT q.*, m.nome_mod 
            FROM quadra q
            JOIN quadra_mod qm ON q.cod_quadra = qm.cod_quadra
            JOIN modalidade m ON qm.cod_modalidade = m.cod_modalidade
            WHERE 1=1");
        $quadras = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calcular distância para cada quadra
        foreach ($quadras as &$q) {

            $endereco_q =
                $q['rua'] . ', ' .
                $q['bairro'] . ', ' .
                $q['cidade'] . ', Brasil';

            $geo_q = $this->geocodificarAzure($endereco_q, $this->AZURE_KEY);

            if (!$geo_q) {
                $q["distancia_m"] = false;
                continue;
            }

            $lat_q = $geo_q["lat"];
            $lon_q = $geo_q["lon"];


            if (!$lat_q || !$lon_q) {
                $q["distancia_m"] = false;
                continue;
            }

            $dist = $this->distanciaRotaAzure(
                $lat_orig,
                $lon_orig,
                $lat_q,
                $lon_q,
                $this->AZURE_KEY
            );

            $q["distancia_m"] = $dist;
        }

        // Remover quadras sem distância válida
        $validas = array_filter($quadras, fn($q) => $q["distancia_m"] !== false);

        if (count($validas) < 3) {
            // fallback: usar as mais próximas com geocoding falho
            $validas = $quadras;
        }

        // Ordenar por distância
        usort($quadras, function ($a, $b) {
            if ($a["distancia_m"] === false) return 1;
            if ($b["distancia_m"] === false) return -1;
            return $a["distancia_m"] <=> $b["distancia_m"];
        });


        // Selecionar 3 mais próximas
        $maisProximas = array_slice($quadras, 0, $qnt_quadras);



        foreach ($maisProximas as $q) {

            // Define imagem final
            $imgSrc = BASE_URL . '/assets/img/quadra-fut.png';
            if (!empty($q['imagem'])) {
                $nomeImg = $q['imagem'];
                $pathQuadras = BASE_PATH . '/assets/img/quadras/' . $nomeImg;
                $pathLugares = BASE_PATH . '/assets/img/' . $nomeImg;

                if (file_exists($pathQuadras)) {
                    $imgSrc = BASE_URL . '/assets/img/quadras/' . $nomeImg;
                } elseif (file_exists($pathLugares)) {
                    $imgSrc = BASE_URL . '/assets/img/' . $nomeImg;
                }
            }

            echo '
                <div class="cardQuadra">
                    <div class="cardImageContainer">
                        <img src="' . $imgSrc . '" 
                            alt="Foto da ' . htmlspecialchars($q['nome_quadra']) . '" 
                            onerror="this.src=\'' . BASE_URL . '/assets/img/quadra-fut.png\'">
                    </div>

                    <div class="infoQuadra">
                        <h3 class="tituloQuadra">' . htmlspecialchars($q['nome_quadra']) . '</h3>
                        <p class="localQuadra">
                            <i class="fas fa-map-marker-alt"></i> ' . htmlspecialchars($q['bairro']) . '
                        </p>

                        <div class="detalhesQuadra">
                            <p><span>Distância:</span> ' . htmlspecialchars($q['distancia_m']) . '</p>
                            <p><span>Esporte:</span> ' . htmlspecialchars($q['nome_mod']) . '</p>
                            <p><span>Tamanho:</span> ' . htmlspecialchars($q['tamanho']) . '</p>
                        </div>

                        <p class="precoQuadra">
                            R$ ' . number_format($q['valor_hora'], 2, ',', '.') . '/h
                        </p>

                        <a href="' . BASE_URL . '/pages/produto.php?id=' . $q['cod_quadra'] . '" 
                        class="btnReservar">
                        Veja mais
                        </a>
                    </div>
                </div>
            ';
        }
    }
}
