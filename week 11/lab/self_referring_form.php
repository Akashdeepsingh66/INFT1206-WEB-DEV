<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewpoint" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>INFT 1206 - Self Referring Form with PostgreSQL</title>
    <link rel="stylesheet" href="css/styles.css">


</html>

<body>
<h1>Self-Referring Form With PostgreSQL</h1>
<p>This script demonstrates a self-referring form and interaction with PostgreSQL</p>


<?php

//Include the database connection file.
require_once "db_connection.php";

//Initialize variables to store the user input
$name = $email = $country = '';
$errors =[];
$msg ='';

if($_SERVER["REQUEST_METHOD"] == "POST"){


    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $country = htmlspecialchars($_POST["country"]);

    //verify that name field was submitted
    if(empty($name)){
        $errors['name'] = "Name is required";
    }

    //Verify that proper email (format) was provided
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Valid Email is required";
    }

    //Verify that country was submitted
    if(empty($country)){
        $errors['country'] = "Country is required";
    }

    //if no errors detected, then we can proceed to database operations
    if(empty($errors)){

        try {

            //establish a connection to the PostgreSQL database
            $dbconn = getDbConnection();

            $result = pg_prepare($dbconn, "my_query",
                'INSERT INTO users (name, email, country) VALUES($1, $2, $3)');

            //execute insert
            $result = pg_execute($dbconn, "my_query", array($name, $email, $country));

            if($result){
                $msg = "User added successfully!";
                $name = $email = $country = '';
            }else{
                $msg = "An error occurred while adding user!";
            }

            //close database connection
            pg_close($dbconn);

        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}


?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <!--Text Input for Name-->
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name;?>" required>
    <span class="error"><?php echo $errors['name'] ?? '';?></span><br>

    <!--Text Input  for Email-->
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email;?>" required>
    <span class="error"><?php echo $errors['email'] ?? '';?></span><br>

    <label for="country">Country: </label>
    <select id="country" name="country">
        <option value=""disabled selected>Select your Country</option>
        <option value="Canada" <?php if($country == 'Canada'){echo 'selected';}?>>Canada</option>
        <option value="USA" <?php if($country == 'USA'){echo 'selected';}?>>USA</option>
        <option value="Mexico" <?php if($country == 'Mexico'){echo 'selected';}?>>Mexico</option>
    </select>
    <span class="error"><?php echo $errors['country'] ?? '';?></span><br>

    <input type="submit" value="Submit">

</form>

<p><?php echo $msg; ?></p>




</body>