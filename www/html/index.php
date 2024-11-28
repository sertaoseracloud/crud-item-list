<?php
include 'db.php';
include 'classes.php';


// Instância do banco de dados
$db = new Database();

// Processar requisições
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    $stmt = $db->query("SELECT * FROM tortas WHERE id = :id", ['id' => $id]);
    $tortaData = $db->fetch($stmt);

    $torta = ($tortaData['preco'] > 20) ?
        new TortaPremium($tortaData['id'], $tortaData['nome'], $tortaData['preco'], $tortaData['quantidade']) :
        new Torta($tortaData['id'], $tortaData['nome'], $tortaData['preco'], $tortaData['quantidade']);

    if ($action == 'add') {
        $torta->setQuantidade($torta->getQuantidade() + 1);
    } elseif ($action == 'remove' && $torta->getQuantidade() > 0) {
        $torta->setQuantidade($torta->getQuantidade() - 1);
    }

    $newQuantity = $torta->getQuantidade();
    $db->query("UPDATE tortas SET quantidade = :quantidade WHERE id = :id", [
        'quantidade' => $newQuantity,
        'id' => $id
    ]);
}

// Recuperar dados do banco
$stmt = $db->query("SELECT * FROM tortas");
$tortas = $db->fetchAll($stmt);

// Calcular o total e subtotais
$total = 0;
foreach ($tortas as $row) {
    $torta = ($row['preco'] > 20) ?
        new TortaPremium($row['id'], $row['nome'], $row['preco'], $row['quantidade']) :
        new Torta($row['id'], $row['nome'], $row['preco'], $row['quantidade']);

    $subtotal = $torta->calcularSubtotal();
    $total += $subtotal;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>PDV - Empresa de Tortas</title>
</head>
<body class="w3-padding-large">

<div class="w3-container w3-card w3-margin-bottom">
    <h2>PDV - Empresa de Tortas</h2>
</div>


    <table class="w3-table-all w3-hoverable w3-container w3-card">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço (R$)</th>
                <th>Quantidade</th>
                <th>Subtotal (R$)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tortas as $row): ?>
                <?php 
                    $torta = ($row['preco'] > 20) ?
                        new TortaPremium($row['id'], $row['nome'], $row['preco'], $row['quantidade']) :
                        new Torta($row['id'], $row['nome'], $row['preco'], $row['quantidade']);
                    $subtotal = $torta->calcularSubtotal();
                ?>
                <tr>
                    <td><?= $row['nome'] ?></td>
                    <td><?= number_format($row['preco'], 2, ',', '.') ?></td>
                    <td><?= $row['quantidade'] ?></td>
                    <td><?= number_format($subtotal, 2, ',', '.') ?></td>
                    <td>
                        <form method="POST" class="w3-margin-bottom" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button name="action" value="add" class="w3-button w3-green">Adicionar</button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button name="action" value="remove" class="w3-button w3-red">Remover</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


<!-- Exibir Total -->
<div class="w3-container w3-card w3-margin-top">
    <h3>Total: R$ <?= number_format($total, 2, ',', '.') ?></h3>
</div>

</body>
</html>