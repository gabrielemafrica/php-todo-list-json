<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

// Ricevi l'indice del todo da eliminare inviato tramite la richiesta POST
// $dati = $_POST;
$indexDelete = $_POST['index'];

// Prelevo tutti i dati dall'array nel file data.json
$dataString = file_get_contents('data.json');
$todoList = json_decode($dataString, true);

// Elimina l'oggetto corrispondente all'indice fornito dall'array
// Option 1: Utilizzando unset() e la chiave dell'array
// foreach ($todoList as $key => &$todo) {
//     if ($todo['id'] === $dati['id']) {
//         unset($todoList[$key]);
//         break;
//     }
// }

// Option 2: Utilizzando array_splice() per rimuovere l'elemento dall'array
array_splice($todoList, $indexDelete, 1);

// Codifica le modifiche in formato JSON
$encodedList = json_encode($todoList);

// Scrive i dati nel file data.json
file_put_contents("data.json", $encodedList);

// Restituisce l'array JSON come risposta
echo $encodedList;

