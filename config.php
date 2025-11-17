<?php

define("DB_HOST", "localhost");
define("DB_USER", "root"); // Usuário padrão do XAMPP
define("DB_PASS", "");     // Senha padrão do XAMPP
define("DB_NAME", "meu_projeto_contatos");

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexão bem-sucedida!"; // Descomente para testar a conexão
} catch (PDOException $e) {
    die("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
}
