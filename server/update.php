<?php declare(strict_types=1);

/*
* imports
*/
include 'RequestHandler.php';

// sql query with prepared statement
$sql = "UPDATE users SET email = :email WHERE id= :id";

$requestHandler = new RequestHandler($sql, ["email" => "john5@gmail.com", "id" => 6]);
$requestHandler->executeQuery();