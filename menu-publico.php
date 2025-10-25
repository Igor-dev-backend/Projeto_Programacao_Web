<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuExpress - Cardápio Público</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .public-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            text-align: center;
        }
        
        .public-header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 700;
        }
        
        .public-header p {
            margin: 0.5rem 0 0 0;
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .auth-banner {
            background: #3498db;
            color: white;
            padding: 1rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .auth-banner p {
            margin: 0;
            font-size: 1rem;
        }
        
        .auth-banner a {
            color: white;
            text-decoration: underline;
            font-weight: 600;
            margin: 0 0.5rem;
        }
        
        .auth-banner a:hover {
            color: #f0f0f0;
        }
        
        .public-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .public-btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-login {
            background: #27ae60;
            color: white;
        }
        
        .btn-login:hover {
            background: #229954;
            transform: translateY(-2px);
        }
        
        .btn-register {
            background: #e74c3c;
            color: white;
        }
        
        .btn-register:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
        
        .btn-back {
            background: #95a5a6;
            color: white;
        }
        
        .btn-back:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }
        
        .menu-note {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .menu-note i {
            margin-right: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .public-header h1 {
                font-size: 2rem;
            }
            
            .public-actions {
                flex-direction: column;
                align-items: center;
            }
            
            .public-btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <header class="public-header">
        <div class="container">
            <h1><i class="fas fa-utensils"></i> MenuExpress</h1>
            <p>Cardápio Digital do Nosso Restaurante</p>
        </div>
    </header>

    <div class="auth-banner">
        <div class="container">
            <p>
                <i class="fas fa-info-circle"></i>
                Você está visualizando o cardápio como visitante. 
                <a href="login.php">Faça login</a> ou 
                <a href="cadastro.php">cadastre-se</a> para uma experiência completa!
            </p>
        </div>
    </div>

    <div class="container">
        <div class="public-actions">
            <a href="login.php" class="public-btn btn-login">
                <i class="fas fa-sign-in-alt"></i> Entrar
            </a>
            <a href="cadastro.php" class="public-btn btn-register">
                <i class="fas fa-user-plus"></i> Cadastrar
            </a>
            <a href="welcome.php" class="public-btn btn-back">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="menu-note">
            <i class="fas fa-eye"></i>
            <strong>Visualização Pública:</strong> Você pode ver todos os pratos do nosso cardápio, 
            mas algumas funcionalidades podem estar limitadas.
        </div>

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

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 MenuExpress. Todos os direitos reservados.</p>
            <a href="admin/" class="admin-link">Área Administrativa</a>
        </div>
    </footer>

    <script src="assets/js/script.js"></script>
    <script>
        // Adicionar efeitos de hover nos botões
        document.querySelectorAll('.public-btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Animação de entrada dos itens do menu
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    item.style.transition = 'all 0.5s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
