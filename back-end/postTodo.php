<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

// Prendo i dati POST inviati da app.vue
$newTodo = $_POST;
$newTodo['do'] = true;
$newTodo['id'] = uniqid(); // Assegna un ID univoco

// Prelevo l'array di dati dal file data.json
$dataString = file_get_contents('data.json');
$todoList = json_decode($dataString, true);

// Aggiungo il nuovo todo all'array
$todoList[] = $newTodo;

// Codifico l'array in formato JSON
$encodedList = json_encode($todoList);

// Scrivo l'array nel file data.json
file_put_contents("data.json", $encodedList);

// Restituisco l'array JSON come risposta
echo $encodedList;
