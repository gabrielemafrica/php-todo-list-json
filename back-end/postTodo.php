<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

//prendo i dati post inviati da app.vue
$newTodo = $_POST;
$newTodo['do'] = true;
$newTodo['id'] = uniqid(); // Assegna un ID univoco;

$dataString = file_get_contents('data.json');
$todoList = json_decode($dataString, true);

//aggiungo il nuovo todo
$todoList[] = $newTodo;

//codifico in json
$encodeList = json_encode($todoList);

//metto il file
file_put_contents("data.json", $encodeList);

echo $encodeList;


// Cancella i dati $_POST
unset($_POST);