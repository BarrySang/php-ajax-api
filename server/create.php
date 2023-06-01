<?php declare(strict_types=1);

/*
* imports
*/
// class imports
include 'RequestHandler.php';
include 'SQLGenerator.php';

// sql query with prepared statement
$sqlGen = new SQLGenerator("insert", "users", ["firstname" => "john", "lastname" => "doe", "username" => "johndoe", "email" => "john3@gmail.com", "password" => "john123"]);

// create a requestHandler object
$requestHandler = new RequestHandler($sqlGen->generateSql(), ["firstname" => "john", "lastname" => "doe", "username" => "johndoe", "email" => "john3@gmail.com", "password" => "john123"]);

// connect to database and run query
$requestHandler->executeQuery();