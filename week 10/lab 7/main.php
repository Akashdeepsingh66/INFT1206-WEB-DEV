<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFT1206 - LAB7</title>
    <link rel="stylesheet" href="css/style.css"
</head>

<body>
<h1>PostgreSQL Database Interaction</h1>
<p>This script demonstrates how to interact with a PostgreSQL database using PHP.</p>

<?php
require_once 'db_connection.php';

if($pdo) {

    try{
        $insertQuery = "INSERT INTO users (name,email,country) VALUES (:name,:email,:country)";
        $stmt = $pdo->prepare($insertQuery);
        $stmt->execute([
            'name' => 'Ranjit bawa',
            'email' => "ranjit67@xyz.com",
            'country' => 'INDIA'
        ]);

        echo "<p>User added successfully.</p>";

        //READ
        //retrieve all users from database
        $selectQuery = "SELECT * FROM users";
        $stmt = $pdo->prepare($selectQuery);
        $stmt->execute();


        echo "<h2>Users</h2>";
        echo "<ul>";
        while($row = $stmt->fetch()) {
            echo "<li><strong>ID:</strong>{$row['id']},
                                <strong>Name: </strong>{$row['name']}
                                <strong>Email: </strong>{$row['email']}
                                <strong>Country: </strong>{$row['country']}
                                </li>";
            ;

        }

        echo "</ul>";

        //UPDATE
        $updateQuery = "UPDATE users SET email = :email WHERE name = :name";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([
            'email'=> 'ranjit bawa',
            'name' => 'Ranjit bawa',
        ]);

        echo "<p>User updated successfully.</p>";

        //DELETE
        $deleteQuery = "DELETE FROM users WHERE name = :name";
        $stmt = $pdo->prepare($deleteQuery);
        $stmt->execute([
            'name' => 'Ranjit bawa',
        ]);


        echo "<p>User deleted successfully.</p>";


    }catch(PDOException $e) {
        echo "<p>Error executing query</p>" . $e->getMessage();

    }
}
?>


</body>



</html>