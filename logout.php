<?php
session_start();

// Destruir todas as variáveis de sessão do cliente
unset($_SESSION['cliente_logado']);
unset($_SESSION['cliente_id']);
unset($_SESSION['cliente_nome']);
unset($_SESSION['cliente_email']);

// Redirecionar para a página principal
header('Location: index.php');
exit;
?>
