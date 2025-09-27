<?php
// Initialize the name variable
$name = '';

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the submitted name
    $name = "Hello, {$_POST['name']}!";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Name Input Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <form action="index.php" method="post">
        <label for="name">Enter your name:</label>
        <input type="text" id="name" name="name" class="form-control">
        <input type="submit" value="Submit" class="btn btn-primary mt-2">
    </form>
    <p><?php echo htmlspecialchars($name); ?></p>
</body>
</html>
