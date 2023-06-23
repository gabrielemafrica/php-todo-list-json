<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");

// Prendo i dati dall'array nel file data.json
$string = file_get_contents('data.json');
$todo = json_decode($string, true);

// Debug: Stampa i dati nell'array
// echo "<pre>";
// var_dump($todo);
// echo "</pre>";

// Imposto l'header della risposta come JSON
header('Content-Type: application/json');

// Codifico l'array in formato JSON e lo restituisco come risposta
echo json_encode($todo);
