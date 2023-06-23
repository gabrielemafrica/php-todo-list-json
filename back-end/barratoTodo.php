<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

// Ricevi l'indice del todo da barrare inviato tramite la richiesta POST
$indexBarrato = $_POST['index'];

// Prelevo tutti i dati dall'array nel file data.json
$dataString = file_get_contents('data.json');
$todoList = json_decode($dataString, true);

// Modifica il valore "barrato" dell'oggetto corrispondente all'indice fornito
$todoList[$indexBarrato]['barrato'] = !$todoList[$indexBarrato]['barrato'];

// Codifica le modifiche in formato JSON
$encodedList = json_encode($todoList);

// Scrive i dati nel file data.json
file_put_contents("data.json", $encodedList);

// Restituisce l'array JSON come risposta
echo $encodedList;
