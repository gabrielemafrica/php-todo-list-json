<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

// Ricevi i dati inviati tramite la richiesta POST

$dati = $_POST;
// $dati = file_get_contents("php://input");
// //li decodifico
// $datiDecodificati = json_decode($dati, true);

//prendo tutti i dati
$dataString = file_get_contents('data.json');
$todoList = json_decode($dataString, true);

//ciclo lista per trovare il mio oggetto
foreach ($todoList as $key => &$todo) {
    if ($todo['to'] === $dati['to']) {
        //elimino oggetto dall array
        unset($todoList[$key]);
        break;
    }
}

//salvo le modifiche e le codifico in json
$encodeList = json_encode($todoList);

//metto i dati nel file
file_put_contents("data.json", $encodeList);

//stampo
echo $encodeList;