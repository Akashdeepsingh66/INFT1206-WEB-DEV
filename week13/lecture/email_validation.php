<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$email = '';
$error = [];
$msg = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = htmlspecialchars(trim($_POST["email"]));

    if(empty($email)){
        $error['email'] = "Please enter your email address";

    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error['email'] = "Invalid email format";
    }
}

if(empty($error)){

    $mail = new PHPMailer(true);

    try{
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Username = 'ea750d3e142538';
        $mail->Password = '09d309f5a92f39';

        $mail->setFrom('himmat.sandhu@dcmail.ca', 'WAYMAKER');
        $mail->addAddress($email);
        $mail->Subject = 'Welcome to WAYMAKER';
        $mail->Body = 'Thank You for signing up';

        if($mail->send()){
            header('location: success.php');
            exit();

        }else{
            $msg = "Error: Unable to send email ";
        }

    }catch(Exception $e){
        $msg = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang ="en">
<body>


<head>
    <meta charset="utf=8">
    <meta name="viewpoint" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>INFT 1206 - Lab 10</title>
    <link rel="stylesheet" href="css/style.css"

</head>

<h1>PHP Email Validation and Redirection</h1>
<p>This script demonstrates email validation and redirection</p>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    <label for="email">Email: </label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
    <span class="error"><?php echo $error['email']; ?></span><br>
    <input type="submit" value="Submit">

</form>


<p><?php echo $msg; ?></p>

</body>
</html>