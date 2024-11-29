<?php

//Lab8 Database Connection Details
$host = "host.docker.internal";
#host = "127.0.0.1";
$port = "5435";
$dbname = "Lab9";
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