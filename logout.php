<?php
// ============================================
// PÁGINA DE LOGOUT
// ============================================

// Iniciar sessão para poder removê-la
session_start();

// Remover todas as variáveis de sessão do cliente
unset($_SESSION['cliente_logado']);
unset($_SESSION['cliente_id']);
unset($_SESSION['cliente_nome']);
unset($_SESSION['cliente_email']);

// Redirecionar para a página principal (que vai redirecionar para welcome.php)
header('Location: index.php');
exit;
?>
