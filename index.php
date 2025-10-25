<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuExpress - Cardápio Online</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="header-left">
                    <h1><i class="fas fa-utensils"></i> MenuExpress</h1>
                    <p>Cardápio Digital do Nosso Restaurante</p>
                </div>
                <div class="header-right">
                    <?php if (isset($_SESSION['cliente_logado'])): ?>
                        <div class="user-menu">
                            <span class="welcome">Olá, <?php echo htmlspecialchars($_SESSION['cliente_nome']); ?>!</span>
                            <div class="user-actions">
                                <a href="perfil.php" class="btn btn-outline">
                                    <i class="fas fa-user"></i> Perfil
                                </a>
                                <a href="logout.php" class="btn btn-outline">
                                    <i class="fas fa-sign-out-alt"></i> Sair
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="auth-actions">
                            <a href="login.php" class="btn btn-outline">
                                <i class="fas fa-sign-in-alt"></i> Entrar
                            </a>
                            <a href="cadastro.php" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i> Cadastrar
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="menu-grid">
                <?php
                try {
                    $stmt = $pdo->query("SELECT * FROM pratos ORDER BY nome ASC");
                    $pratos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (empty($pratos)) {
                        echo '<div class="no-items">';
                        echo '<i class="fas fa-utensils"></i>';
                        echo '<h3>Nenhum prato cadastrado ainda</h3>';
                        echo '<p>Volte em breve para ver nosso cardápio!</p>';
                        echo '</div>';
                    } else {
                        foreach ($pratos as $prato) {
                            echo '<div class="menu-item">';
                            echo '<div class="item-image">';
                            if (!empty($prato['imagem'])) {
                                echo '<img src="' . htmlspecialchars($prato['imagem']) . '" alt="' . htmlspecialchars($prato['nome']) . '">';
                            } else {
                                echo '<div class="no-image"><i class="fas fa-image"></i></div>';
                            }
                            echo '</div>';
                            echo '<div class="item-content">';
                            echo '<h3>' . htmlspecialchars($prato['nome']) . '</h3>';
                            echo '<p class="description">' . htmlspecialchars($prato['descricao']) . '</p>';
                            echo '<div class="price">R$ ' . number_format($prato['preco'], 2, ',', '.') . '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                } catch (PDOException $e) {
                    echo '<div class="error">Erro ao carregar o cardápio: ' . $e->getMessage() . '</div>';
                }
                ?>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 MenuExpress. Todos os direitos reservados.</p>
            <a href="admin/" class="admin-link">Área Administrativa</a>
        </div>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>
