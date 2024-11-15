<?php

$host = "host.docker.internal";
$port = "5435";
$dbname = "Lab7";
$user = "admin";
$password = "password";

try {

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,            //Enables exception for errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       //Fetch data as associative array
    ]);

} catch (PDOException $e) {
    echo "<p>Error connecting to the database" . $e->getMessage() . "</p>";
    exit;
}