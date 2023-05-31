<?php declare(strict_types=1);

// imports
include 'RequestHandler.php';

$clientRequest = $_GET;

$sql = "SELECT * FROM users WHERE id = :id";

$read = new RequestHandler($sql, ["id" => 6]);

$result = $read->executeQuery();
var_dump($result);
