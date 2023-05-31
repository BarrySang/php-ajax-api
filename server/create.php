<?php declare(strict_types=1);

/*
* imports
*/
// class imports
include 'RequestHandler.php';

// sql query with prepared statement
$sql = "INSERT INTO users (firstname, lastname, username, email, password) VALUES (:firstname, :lastname, :username, :email, :password)";

// values for use in the prepared statement
$reqValues = array('john', 'doe', 'johndoe', 'john2@gmail.com', 'john123');

// create a user object
$user = new RequestHandler($sql, ["firstname" => "john", "lastname" => "doe", "username" => "johndoe", "email" => "john3@gmail.com", "password" => "john123"]);

// connect to database and run query
$user->executeQuery();