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
        if (!$latOrig || !$lonOrig || !$latDest || !$lonDest) {
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
    // CÁLCULO FINAL DE DISTÂNCIA
    // ------------------------------
    public function calcularDistancia()
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
        $stmt = $pdo->query("SELECT * FROM quadra");
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
        $validas = array_filter($quadras, fn ($q) => $q["distancia_m"] !== false);

        if (count($validas) < 3) {
            // fallback: usar as mais próximas com geocoding falho
            $validas = $quadras;
        }

        // Ordenar por distância
        usort($quadras, fn ($a, $b) => $a["distancia_m"] <=> $b["distancia_m"]);

        // Selecionar 3 mais próximas
        $maisProximas = array_slice($quadras, 0, 3);

        // Exibir
        echo "<h2>As 3 quadras mais próximas:</h2>";
        echo "<pre>";

        foreach ($maisProximas as $q) {
            echo "<p><strong>{$q['nome_quadra']}</strong><br>";
            echo "Distância pelas ruas: " . round($q["distancia_m"] / 1000, 2) . " km</p>";
        }
    }
}
