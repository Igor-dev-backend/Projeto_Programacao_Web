<?php
// Iniciar sessão sem depender do config.php inicialmente
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se já estiver logado, redirecionar para o cardápio
if (isset($_SESSION['cliente_logado']) && $_SESSION['cliente_logado'] === true) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuExpress - Bem-vindo</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilos da página de boas-vindas - Identidade Visual MenuExpress */
        .welcome-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #FF5733 0%, #FFC300 100%);
            padding: 2rem;
        }
        
        .welcome-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(44, 44, 44, 0.2);
            padding: 3rem;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        
        .welcome-header {
            margin-bottom: 2rem;
        }
        
        .welcome-header .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .welcome-header .logo-container .logo {
            justify-content: center;
        }
        
        .welcome-header .subtitle {
            color: #2C2C2C;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            font-family: 'Poppins', 'Montserrat', sans-serif;
        }
        
        .welcome-header .description {
            color: #666;
            font-size: 1rem;
            line-height: 1.6;
        }
        
        .welcome-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .action-btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            font-family: 'Open Sans', 'Lato', sans-serif;
        }
        
        .btn-primary {
            background: #FF5733;
            color: white;
            box-shadow: 0 4px 8px rgba(255, 87, 51, 0.3);
        }
        
        .btn-primary:hover {
            background: #E64A2E;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 87, 51, 0.4);
        }
        
        .btn-secondary {
            background: #FFC300;
            color: #2C2C2C;
            box-shadow: 0 4px 8px rgba(255, 195, 0, 0.3);
        }
        
        .btn-secondary:hover {
            background: #E6B000;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 195, 0, 0.4);
        }
        
        .btn-outline {
            background: transparent;
            color: #FF5733;
            border: 2px solid #FF5733;
        }
        
        .btn-outline:hover {
            background: #FF5733;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 87, 51, 0.3);
        }
        
        .features {
            margin-top: 2rem;
            padding: 1.5rem;
            background: #F8F8F8;
            border-radius: 12px;
            text-align: left;
        }
        
        .features h3 {
            color: #2C2C2C;
            margin-bottom: 1rem;
            text-align: center;
            font-family: 'Poppins', 'Montserrat', sans-serif;
            font-weight: 700;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
        }
        
        .feature-list li {
            padding: 0.5rem 0;
            color: #666;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .feature-list i {
            color: #8CC63F;
            width: 20px;
        }
        
        .demo-info {
            margin-top: 1.5rem;
            padding: 1rem;
            background: #FFF3E0;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #2C2C2C;
            border-left: 4px solid #FFC300;
        }
        
        .demo-info strong {
            color: #FF5733;
        }
        
        @media (max-width: 480px) {
            .welcome-container {
                padding: 1rem;
            }
            
            .welcome-card {
                padding: 2rem;
            }
            
            .welcome-header .subtitle {
                font-size: 1.1rem;
            }
            
            .welcome-actions {
                gap: 0.8rem;
            }
            
            .action-btn {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-card">
            <div class="welcome-header">
                <div class="logo-container">
                    <?php include 'logo.php'; ?>
                </div>
                <p class="subtitle">Seu cardápio, na palma da mão</p>
                <p class="description">
                    Explore nossos pratos deliciosos e desfrute de uma experiência gastronômica moderna e rápida.
                </p>
            </div>
            
            <div class="welcome-actions">
                <a href="login.php" class="action-btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Entrar na minha conta
                </a>
                
                <a href="cadastro.php" class="action-btn btn-secondary">
                    <i class="fas fa-user-plus"></i> Criar nova conta
                </a>
                
                <a href="menu-publico.php" class="action-btn btn-outline">
                    <i class="fas fa-eye"></i> Ver cardápio sem login
                </a>
            </div>
            
            <div class="features">
                <h3><i class="fas fa-star"></i> Por que escolher o MenuExpress?</h3>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> Cardápio sempre atualizado</li>
                    <li><i class="fas fa-check"></i> Fotos dos pratos</li>
                    <li><i class="fas fa-check"></i> Preços transparentes</li>
                    <li><i class="fas fa-check"></i> Interface intuitiva</li>
                    <li><i class="fas fa-check"></i> Acesso rápido e fácil</li>
                </ul>
            </div>
            
            <div class="demo-info">
                <strong>💡 Dica:</strong> Você pode explorar nosso cardápio mesmo sem fazer login! 
                Use a opção "Ver cardápio sem login" para conhecer nossos pratos.
            </div>
        </div>
    </div>
    
    <script>
        // Adicionar efeitos de hover suaves
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.action-btn');
            buttons.forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Animação de entrada
            const card = document.querySelector('.welcome-card');
            if (card) {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                
                setTimeout(function() {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>
</body>
</html>