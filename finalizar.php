<?php
session_start();
$pagamento = $_POST['pagamento'] ?? "Indefinido";
$_SESSION['carrinho'] = []; // limpa carrinho
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Pedido Finalizado</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Pedido Finalizado!</h1>
    <p>Forma de Pagamento escolhida: <strong><?= $pagamento ?></strong></p>
    <a class="btn" href="carrinho.php">Voltar ao início</a>
</div>

</body>
</html>
