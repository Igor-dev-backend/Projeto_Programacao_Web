<?php
session_start();
if (empty($_SESSION['carrinho'])) {
    header("Location: carrinho.php");
    exit;
}

// Produtos fictícios (mesmos do carrinho)
$produtos = [
    1 => ["nome" => "Hambúrguer Artesanal", "preco" => 18.90],
    2 => ["nome" => "Batata Frita Grande", "preco" => 12.50],
    3 => ["nome" => "Refrigerante Lata", "preco" => 6.00],
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Checkout</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Checkout</h1>

    <h2>Resumo do Pedido</h2>

    <table>
        <tr>
            <th>Item</th>
            <th>Qtd</th>
            <th>Total</th>
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
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="total">
        Total Final: <strong>R$ <?= number_format($total, 2, ',', '.') ?></strong>
    </div>

    <h2>Forma de Pagamento</h2>

    <form action="finalizar.php" method="POST">
        <label><input type="radio" name="pagamento" value="Pix" required> Pix</label><br>
        <label><input type="radio" name="pagamento" value="Cartão"> Cartão de Crédito</label><br>
        <label><input type="radio" name="pagamento" value="Dinheiro"> Dinheiro</label><br><br>

        <button class="btn-finalizar" type="submit">Finalizar Pedido</button>
    </form>
</div>

</body>
</html>
