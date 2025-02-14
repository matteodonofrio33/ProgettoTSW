<?php
header('Content-Type: application/json');

if (!isset($_GET['citta']) || empty($_GET['citta'])) {
    echo json_encode(["error" => "Nome stadio non fornito"]);
    exit;
}

$citta = urlencode($_GET['citta']);
$apiKey = "09515bcce37bc93c4496846db36038b7"; // Sostituisci con una valida
$url = "https://api.openweathermap.org/data/2.5/weather?q=$citta&appid=$apiKey&units=metric&lang=it";

// Effettua la richiesta
$response = file_get_contents($url);

if ($response === false) {
    echo json_encode(["error" => "Errore nel recupero del meteo da OpenWeather"]);
    exit;
}

// Debug per verificare la risposta ricevuta
$data = json_decode($response, true);
echo json_encode(["debug" => "Risposta API ricevuta", "dati" => $data]);
?>
