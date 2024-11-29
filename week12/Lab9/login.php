<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>INFT1206 - Lab9 - PHP User Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<h1>PHP User Login with PostgreSQL</h1>
<p>This script demonstrates a user login system using PHP and PostgreSQL</p>

<?php


require_once 'db_connection.php';

//Initialize variable to store user input and messages

$username='';
$errors = [];
$msg = '';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars(trim($_POST["username"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    if (empty($username)) {
        $errors['username'] = "Username cannot be empty";

    }

    if (empty($password)) {
        $errors['password'] = "Password cannot be empty";
    }

    if (empty($errors)) {

        try {

            $db_conn = getDbConnection();
            $query = "SELECT * FROM users WHERE username = $1";
            $result = pg_prepare($db_conn, 'login_query', $query);
            $result = pg_execute($db_conn, 'login_query', array($username));

            if ($result && pg_num_rows($result) > 0) {

                $user = pg_fetch_assoc($result);

                //verify the password
                if (password_verify($password, $user['password'])) {

                    $msg = "Login successful! Welcome," . htmlspecialchars($username);

                } else {
                    $msg = "Error: Wrong password!";
                }

            } else {
                $msg = "Error: Invalid username or password!";
            }
            pg_close($db_conn);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo $e->getMessage();
        }
    }

}

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    <label for="username">Username: </label>
    <input type="text" id="username" name="username" value="<?php echo $username;?>" required></input>
    <span class="error"><?php echo $errors['username'] ?? ''; ?></span>

    <label for="password">Password: </label>
    <input type="password" id="password" name="password" value="<?php echo $password;?>" required></input>
    <span class="error"><?php echo $errors['password'] ?? ''; ?></span>

    <input type="submit" value="login">



</form>
<p><?php echo $msg; ?></p>
</body>


</html>