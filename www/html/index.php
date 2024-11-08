<?php
include 'db.php';
$stmt = $pdo->query('SELECT * FROM items');
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <div class="w3-container w3-padding-32">
        <h1 class="w3-center">Item List</h1>
        <a href="create.php" class="w3-button w3-blue w3-margin-bottom">Add New Item</a>
        <table class="w3-table w3-bordered">
            <thead>
                <tr class="w3-blue">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $item['id'] ?>" class="w3-button w3-yellow w3-small">Edit</a>
                            <a href="delete.php?id=<?= $item['id'] ?>" class="w3-button w3-red w3-small">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
