<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'menuexpress';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Configurações gerais
define('SITE_URL', 'http://localhost/menuexpress/');
define('ADMIN_URL', SITE_URL . 'admin/');
define('UPLOAD_PATH', 'assets/uploads/');
?>
