<?php
require_once __DIR__ . '/../conezao.php';

class Endereco {
    // Atributos
    // Primary Key API Azure Maps
    private $AZURE_KEY = "";
    // --------------------------------------------
    // CONFIGURAÇÃO
    // --------------------------------------------
    // $pdo = new PDO("mysql:host=localhost;dbname=sua_base;charset=utf8", "usuario", "senha");
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Métodos
    // Metodo para geocodificar endereco
    public function geocodificarAzure($endereco, $azKey) {
        $url = "https://atlas.microsoft.com/search/address/json?"
             . "api-version=1.0"
             . "&subscription-key=$azKey"
             . "&query=" . urlencode($endereco);
    
        $json = file_get_contents($url);
        $data = json_decode($json, true);
    
        if (!isset($data["results"][0])) {
            return false;
        }
    
        return [
            "lat" => $data["results"][0]["position"]["lat"],
            "lon" => $data["results"][0]["position"]["lon"]
        ];
    }

    // Metodo que calcula distancia via rotas (retorno em metros)
    public function distanciaRotaAzure($latOrig, $lonOrig, $latDest, $lonDest, $azKey) {
        // Azure Maps requer ORIGEM:DESTINO como lon,lat
        $url = "https://atlas.microsoft.com/route/directions/json?"
             . "api-version=1.0"
             . "&subscription-key=$azKey"
             . "&query={$lonOrig},{$latOrig}:{$lonDest},{$latDest}"
             . "&travelMode=car";
    
        $json = file_get_contents($url);
        $data = json_decode($json, true);
    
        if (!isset($data["routes"][0]["summary"]["lengthInMeters"])) {
            return false;
        }
    
        return $data["routes"][0]["summary"]["lengthInMeters"];
    }

    // Metodo para calcular a distancia com endereço (usa os anteriores)
    public function calcularDistancia (
        $uf_orig, $cidade_orig, $rua_orig, $num_orig,
        $uf_dest, $cidade_dest, $rua_dest, $num_dest
        // orig -> origem
        // dest -> destino
    ) {
        // enderecos em uma só string
        $endereco_orig = $cidade_orig . $rua_orig . $num_orig . $uf_orig;
        $endereco_dest = $cidade_dest . $rua_dest . $num_dest . $uf_dest;

        $coord_orig = $this->geocodificarAzure($endereco_orig, $this->AZURE_KEY);
    }
}

// --------------------------------------------
// PASSO 1: Endereço informado pelo usuário
// --------------------------------------------
$enderecoUsuario = "Rua Tal, Centro, Sua Cidade, Brasil"; // substitua
$coordUsuario = geocodificarAzure($enderecoUsuario, $AZURE_KEY);

if (!$coordUsuario) {
    die("Não foi possível geocodificar o endereço.");
}

$latUsuario = $coordUsuario["lat"];
$lonUsuario = $coordUsuario["lon"];

// --------------------------------------------
// PASSO 2: Obter quadras do banco
// --------------------------------------------
$stmt = $pdo->query("SELECT * FROM quadras");
$quadras = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --------------------------------------------
// PASSO 3: Calcular distância real para cada quadra
// --------------------------------------------
foreach ($quadras as &$q) {
    $q["distancia_m"] = distanciaRotaAzure(
        $latUsuario,
        $lonUsuario,
        $q["latitude"],
        $q["longitude"],
        $AZURE_KEY
    );
}



// --------------------------------------------
// PASSO 4: Ordenar pelas mais próximas
// --------------------------------------------
usort($quadras, function ($a, $b) {
    return $a["distancia_m"] <=> $b["distancia_m"];
});



// --------------------------------------------
// PASSO 5: Selecionar as 3 mais próximas
// --------------------------------------------
$maisProximas = array_slice($quadras, 0, 3);



// --------------------------------------------
// SAÍDA — Exemplo de retorno
// --------------------------------------------
echo "<h2>As 3 quadras mais próximas:</h2>";

foreach ($maisProximas as $q) {
    echo "<p><strong>{$q['nome']}</strong><br>";
    echo "Distância pelas ruas: " . round($q["distancia_m"]/1000, 2) . " km</p>";
}

?>
