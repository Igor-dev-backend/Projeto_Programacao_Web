<?php
// ============================================
// CONFIGURAÇÃO DO BANCO DE DADOS
// ============================================
// Altere estas informações conforme seu ambiente

$host = 'localhost';        // Servidor do MySQL (geralmente 'localhost')
$dbname = 'menuexpress';    // Nome do banco de dados
$username = 'root';         // Usuário do MySQL
$password = '';             // Senha do MySQL (vazio por padrão no XAMPP)

// ============================================
// CONEXÃO COM O BANCO DE DADOS
// ============================================
try {
    // Criar conexão usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configurar para mostrar erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Configurar para retornar resultados como array associativo
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // Se houver erro na conexão, mostra mensagem amigável
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}
?>
