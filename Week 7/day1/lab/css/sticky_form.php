<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INFT1206 - PHP Sticky Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Sticky User Information Form</h1>
<p>Please fill out the form below and submit your information. Your input will be retained after submission</p>

<?php
// STEP 1: Initialize variable to store user input
$name = $email = $password = $subscribe = $country = $comments = "";
$errors = [];

// STEP 2: Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // STEP 3: Validate form data
    if (empty($_POST["name"])) {
        $errors['name'] = "Name is required";
    } else {
        $name = htmlspecialchars($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if (empty($_POST["password"])) {
        $errors['password'] = "Password is required";
    } else {
        $password = htmlspecialchars($_POST["password"]);
    }

    // Checkbox (optional, no error needed)
    $subscribe = isset($_POST['subscribe']) ? 'Yes' : 'No';

    // Dropdown (no validation needed for the example, assume it's always valid)
    $country = $_POST['country'] ?? '';

    // Comments (ensure it handles unset value)
    $comments = htmlspecialchars($_POST["comments"] ?? '');
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <!-- Name input Field -->
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo $name; ?>" >
    <span class="error"><?php echo $errors['name'] ?? ''; ?></span>

    <!-- Email Input Field -->
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $email; ?>" >
    <span class="error"><?php echo $errors['email'] ?? ''; ?></span>

    <!-- Password Input Field -->
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" value="<?php echo $password; ?>">
    <span class="error"><?php echo $errors['password'] ?? ''; ?></span>

    <!-- Checkbox input field -->
    <label for="subscribe">Subscribe to Newsletter:</label>
    <input type="checkbox" name="subscribe" id="subscribe" value="Yes" <?php if ($subscribe == 'Yes') echo 'checked'; ?>>

    <!-- Dropdown for selecting Country -->
    <label for="country">Country:</label>
    <select name="country" id="country">
        <option value="Canada" <?php if ($country == 'Canada') echo 'selected'; ?>>Canada</option>
        <option value="USA" <?php if ($country == 'USA') echo 'selected'; ?>>USA</option>
        <option value="Mexico" <?php if ($country == 'Mexico') echo 'selected'; ?>>Mexico</option>
    </select>

    <!-- Text Area -->
    <label for="comments">Comments:</label>
    <textarea name="comments" id="comments" cols="30" rows="10"><?php echo $comments; ?></textarea>

    <!-- Submit Button -->
    <input type="submit" value="Submit"/>

</form>

</body>
</html>
