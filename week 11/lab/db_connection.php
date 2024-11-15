<?php

//Lab8 Database Connection Details
$host = "host.docker.internal";
$port = "5435";
$dbname = "Lab8";
$user = "admin";
$password = "password";


function getDbConnection(){
    global $host, $port, $dbname, $user, $password;
    $conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
    $dbconn = pg_connect($conn_string);

    if(!$dbconn){
        throw new Exception("Connection failed");
    }
    return $dbconn;
}