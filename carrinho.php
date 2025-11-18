<?php
session_start();

// Produtos fictícios para exemplo (cardápio)
$produtos = [
    1 => ["nome" => "Hambúrguer Artesanal", "preco" => 18.90],
    2 => ["nome" => "Batata Frita Grande", "preco" => 12.50],
    3 => ["nome" => "Refrigerante Lata", "preco" => 6.00],
];

// Adicionar item ao carrinho
if (isset($_GET['add'])) {
    $id = $_GET['add'];
    if (!isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id] = 1;
    } else {
        $_SESSION['carrinho'][$id]++;
    }
}

// Remover item
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['carrinho'][$id]);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Carrinho</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>🛒 Seu Carrinho</h1>

    <div class="produtos-lista">
        <h2>Adicionar ao Carrinho</h2>
        <?php foreach ($produtos as $id => $p): ?>
            <div class="produto">
                <span><?= $p["nome"] ?> — R$ <?= number_format($p["preco"], 2, ',', '.') ?></span>
                <a class="btn" href="carrinho.php?add=<?= $id ?>">Adicionar</a>
            </div>
        <?php endforeach; ?>
    </div>

    <hr>

    <h2>Itens no Carrinho</h2>

    <?php if (empty($_SESSION['carrinho'])): ?>
        <p>Seu carrinho está vazio.</p>
    <?php else: ?>

    <table>
        <tr>
            <th>Item</th>
            <th>Qtd</th>
            <th>Preço</th>
            <th></th>
        </tr>

        <?php 
        $total = 0;
        foreach ($_SESSION['carrinho'] as $id => $qtd): 
            $nome = $produtos[$id]["nome"];
            $preco = $produtos[$id]["preco"];
            $subtotal = $preco * $qtd;
            $total += $subtotal;
        ?>
        <tr>
            <td><?= $nome ?></td>
            <td><?= $qtd ?></td>
            <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
            <td><a class="remove" href="carrinho.php?remove=<?= $id ?>">X</a></td>
        </tr>
        <?php endforeach; ?>

    </table>

    <div class="total">
        Total: <strong>R$ <?= number_format($total, 2, ',', '.') ?></strong>
    </div>

    <a class="btn-finalizar" href="checkout.php">Ir para o Checkout</a>

    <?php endif; ?>

</div>

</body>
</html>
