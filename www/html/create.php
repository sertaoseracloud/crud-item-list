<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $stmt = $pdo->prepare('INSERT INTO items (name) VALUES (:name)');
    $stmt->execute(['name' => $name]);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Item</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <div class="w3-container w3-padding-32">
        <h1 class="w3-center">Add New Item</h1>
        <form method="post" class="w3-container w3-card-4 w3-light-grey">
            <div class="w3-row">
                <div class="w3-col s12">
                    <label for="name">Item Name</label>
                    <input type="text" class="w3-input" id="name" name="name" required>
                </div>
            </div>
            <button type="submit" class="w3-button w3-blue w3-margin-top">Add</button>
            <a href="index.php" class="w3-button w3-grey w3-margin-top">Cancel</a>
        </form>
    </div>
</body>
</html>