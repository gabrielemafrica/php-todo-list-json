<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");

$string = file_get_contents('data.json');
$todo = json_decode($string, true);

// echo "<pre>";
// var_dump($todo);
// echo "</pre>";

header('Content-Type: application/json');
echo json_encode($todo);