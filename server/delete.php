<?php declare(strict_types=1);

/**
 * imports
 */
include 'RequestHandler.php';

$sql = "DELETE FROM users WHERE id = :id";
$requestHandler = new RequestHandler($sql, ["id" => 6]);
$requestHandler->executeQuery();