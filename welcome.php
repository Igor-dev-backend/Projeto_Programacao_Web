<?php
session_start();
require_once 'config.php';

// Se já estiver logado, redirecionar para o cardápio
if (isset($_SESSION['cliente_logado'])) {
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
        .welcome-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
        }
        
        .welcome-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        
        .welcome-header {
            margin-bottom: 2rem;
        }
        
        .welcome-header h1 {
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 2.5rem;
            font-weight: 700;
        }
        
        .welcome-header .subtitle {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        
        .welcome-header .description {
            color: #888;
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
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.3);
        }
        
        .btn-outline {
            background: transparent;
            color: #3498db;
            border: 2px solid #3498db;
        }
        
        .btn-outline:hover {
            background: #3498db;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.2);
        }
        
        .features {
            margin-top: 2rem;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 12px;
            text-align: left;
        }
        
        .features h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
            text-align: center;
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
            color: #27ae60;
            width: 20px;
        }
        
        .demo-info {
            margin-top: 1.5rem;
            padding: 1rem;
            background: #e8f4fd;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #2c3e50;
        }
        
        .demo-info strong {
            color: #3498db;
        }
        
        @media (max-width: 480px) {
            .welcome-container {
                padding: 1rem;
            }
            
            .welcome-card {
                padding: 2rem;
            }
            
            .welcome-header h1 {
                font-size: 2rem;
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
                <h1><i class="fas fa-utensils"></i> MenuExpress</h1>
                <p class="subtitle">Bem-vindo ao nosso cardápio digital!</p>
                <p class="description">
                    Explore nossos pratos deliciosos, faça pedidos online e desfrute de uma experiência gastronômica única.
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
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Animação de entrada
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.querySelector('.welcome-card');
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>
