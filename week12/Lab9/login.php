<?php


require_once "db_connection.php";

try {

    //Establish a connectio to the PostgreSQL database
    $dbconn = getDBConnection();

    $username = 'testuser';
    $password = password_hash("password", PASSWORD_BCRYPT); //hash the password

    //Insert the test user into the database
    $insertQuery = "INSERT INTO users(username, password) VALUES($1,$2)";
    $result = pg_prepare($dbconn, 'seed_user', $insertQuery);
    $result = pg_execute($dbconn, 'seed_user', array($username, $password));

    if ($result) {
        echo "Test User seeded successfully!";

    } else {
        echo "Error: Test User not seeded!";
    }
    //close database connection
    pg_close($dbconn);


} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}