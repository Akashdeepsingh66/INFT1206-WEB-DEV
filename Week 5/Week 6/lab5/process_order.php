<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewpoint" content="width=device-width, intial-scale=1">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="css/Style.css">

</head>

<body>

<div class="container">

    <h1>Order Confirmed</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Read the order data from the POST request
        $name = htmlspecialchars($_POST['name'] ?? 'Guest');
        $email = htmlspecialchars($_POST['email'] ?? 'Not provided');
        $orderNumber = htmlspecialchars($_POST['order_number'] ?? 'N/A');
        $items = $_POST['items'] ?? [];

        echo "<p>Thank you, $name!</p>";
        echo "<p>Items ordered:</p><ul>";
        foreach ($items as $item) {
            echo "<li>" . htmlspecialchars($item) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No order data received.</p>";
    }
// Check if there are POST parameters
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read and display request parameters
    foreach ($_POST as $key => $value) {
        // Display each key-value pair safely
        echo htmlspecialchars($key) . ': ' . htmlspecialchars($value) . '<br>';
    }
} else {
    // If no POST data is received
    echo "No order data received.";
}
    ?>


</div>









</body>

</html>