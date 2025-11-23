<?php 

function getCoordinates($address, $apiKey) {
    $url = "https://atlas.microsoft.com/search/address/json" .
        "?api-version=1.0" .
        "&subscription-key=" . urlencode($apiKey) .
        "&query=" . urlencode($address);

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['results'][0]['position'])) {
        return [
            'lat' => $data['results'][0]['position']['lat'],
            'lon' => $data['results'][0]['position']['lon']
        ];
    }

    return false;
}

function getRouteDistance($origin, $destination, $apiKey) {
    $url = "https://atlas.microsoft.com/route/directions/json" .
        "?api-version=1.0" .
        "&subscription-key=" . urlencode($apiKey) .
        "&query={$origin['lat']},{$origin['lon']}:" .
        "{$destination['lat']},{$destination['lon']}";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['routes'][0]['summary']['lengthInMeters'])) {
        return $data['routes'][0]['summary']['lengthInMeters'];
    }

    return false;
}

$apiKey = "SUA_API_KEY_AQUI";

$endereco1 = "Avenida Paulista 1000, São Paulo";
$endereco2 = "Praça da Sé, São Paulo";

// 1. Obter coordenadas
$origem = getCoordinates($endereco1, $apiKey);
$destino = getCoordinates($endereco2, $apiKey);

if (!$origem || !$destino) {
    die("Não foi possível converter os endereços.");
}

// 2. Calcular rota
$distancia = getRouteDistance($origem, $destino, $apiKey);

// Converte metros em km
$distanciaKm = $distancia / 1000;

echo "Distância: $distancia metros ($distanciaKm km)";


?>