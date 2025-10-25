<?php
// Teste de conexão com o banco de dados
echo "<h2>Teste de Conexão - MenuExpress</h2>";

try {
    $host = 'localhost';
    $dbname = 'menuexpress';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✅ Conexão com banco de dados: <strong>SUCESSO</strong></p>";
    
    // Testar se a tabela existe
    $stmt = $pdo->query("SHOW TABLES LIKE 'pratos'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green;'>✅ Tabela 'pratos': <strong>EXISTE</strong></p>";
        
        // Contar registros
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM pratos");
        $count = $stmt->fetch()['total'];
        echo "<p style='color: blue;'>📊 Total de pratos cadastrados: <strong>$count</strong></p>";
        
        if ($count > 0) {
            echo "<p style='color: green;'>✅ Dados encontrados na tabela</p>";
        } else {
            echo "<p style='color: orange;'>⚠️ Tabela vazia - execute o database.sql no phpMyAdmin</p>";
        }
        
    } else {
        echo "<p style='color: red;'>❌ Tabela 'pratos': <strong>NÃO EXISTE</strong></p>";
        echo "<p style='color: orange;'>⚠️ Execute o arquivo database.sql no phpMyAdmin</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Erro na conexão: " . $e->getMessage() . "</p>";
    echo "<p style='color: orange;'>💡 Verifique se:</p>";
    echo "<ul>";
    echo "<li>O MySQL está rodando no XAMPP</li>";
    echo "<li>O banco 'menuexpress' foi criado</li>";
    echo "<li>As credenciais estão corretas no config.php</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<h3>Links para testar:</h3>";
echo "<p><a href='index.php' target='_blank'>🏠 Página Principal (Cardápio)</a></p>";
echo "<p><a href='admin/login.php' target='_blank'>🔐 Painel Administrativo</a></p>";
echo "<p><a href='http://localhost/phpmyadmin' target='_blank'>🗄️ phpMyAdmin</a></p>";
?>
