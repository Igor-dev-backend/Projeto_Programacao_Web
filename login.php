<?php
// ============================================
// PÁGINA DE LOGIN
// ============================================

// Iniciar sessão para armazenar dados do usuário logado
session_start();

// Conectar ao banco de dados
require_once 'config.php';

// Se o usuário já estiver logado, redirecionar para a página principal
if (isset($_SESSION['cliente_logado'])) {
    header('Location: index.php');
    exit;
}

// Variável para armazenar mensagens de erro
$erro = '';

// Verificar se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pegar dados do formulário
    $email = trim($_POST['email'] ?? '');  // trim remove espaços em branco
    $senha = $_POST['senha'] ?? '';
    
    // Validar se os campos não estão vazios
    if (empty($email) || empty($senha)) {
        $erro = 'Preencha todos os campos!';
    } else {
        try {
            // Buscar usuário no banco de dados pelo email
            // Usamos prepared statement para evitar SQL injection
            $stmt = $pdo->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch();
            
            // Verificar se o usuário existe e se a senha está correta
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                // Login bem-sucedido! Armazenar dados na sessão
                $_SESSION['cliente_logado'] = true;
                $_SESSION['cliente_id'] = $usuario['id'];
                $_SESSION['cliente_nome'] = $usuario['nome'];
                $_SESSION['cliente_email'] = $usuario['email'];
                
                // Redirecionar para a página principal
                header('Location: index.php');
                exit;
            } else {
                $erro = 'Email ou senha incorretos!';
            }
        } catch (PDOException $e) {
            $erro = 'Erro ao fazer login: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuExpress - Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #FF5733 0%, #FFC300 100%);
            padding: 2rem;
        }
        
        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        
        .auth-header {
            margin-bottom: 2rem;
        }
        
        .auth-header h1 {
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 2rem;
        }
        
        .auth-header p {
            color: #666;
            font-size: 1rem;
        }
        
        .auth-form {
            text-align: left;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .auth-btn {
            width: 100%;
            padding: 1rem;
            background: #FF5733;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            box-shadow: 0 4px 8px rgba(255, 87, 51, 0.3);
        }
        
        .auth-btn:hover {
            background: #E64A2E;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 87, 51, 0.4);
        }
        
        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .auth-links a {
            color: #FF5733;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .auth-links a:hover {
            color: #E64A2E;
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: 1px solid #f5c6cb;
        }
        
        .back-link {
            position: absolute;
            top: 2rem;
            left: 2rem;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .back-link:hover {
            color: #f0f0f0;
        }
        
        .demo-credentials {
            margin-top: 2rem;
            padding: 1rem;
            background: #FFF3E0;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #2C2C2C;
            border-left: 4px solid #FFC300;
        }
        
        .demo-credentials strong {
            color: #FF5733;
        }
        
        @media (max-width: 480px) {
            .auth-container {
                padding: 1rem;
            }
            
            .auth-card {
                padding: 2rem;
            }
            
            .back-link {
                position: relative;
                top: auto;
                left: auto;
                display: block;
                margin-bottom: 1rem;
                color: #3498db;
            }
        }
    </style>
</head>
<body>
    <a href="index.php" class="back-link">
        <i class="fas fa-arrow-left"></i> Voltar ao Site
    </a>
    
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div style="display: flex; justify-content: center; margin-bottom: 1rem;">
                    <?php 
                    $logo_size = 'compact';
                    include 'logo.php'; 
                    ?>
                </div>
                <h1><i class="fas fa-sign-in-alt"></i> Login</h1>
                <p>Entre na sua conta MenuExpress</p>
            </div>
            
            <?php if ($erro): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i> <?php echo $erro; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" class="auth-form" id="loginForm">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required 
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                
                <button type="submit" class="auth-btn">
                    <i class="fas fa-sign-in-alt"></i> Entrar
                </button>
            </form>
            
            <div class="auth-links">
                <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
            </div>
            
            <div class="demo-credentials">
                <strong>Credenciais de teste:</strong><br>
                Email: <strong>cliente@teste.com</strong><br>
                Senha: <strong>123456</strong>
            </div>
        </div>
    </div>
    
    <script>
        // Foco automático no campo email
        document.getElementById('email').focus();
        
        // Validação em tempo real
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            const senha = document.getElementById('senha').value.trim();
            
            if (!email || !senha) {
                e.preventDefault();
                alert('Preencha todos os campos!');
                return;
            }
        });
        
        // Enter para enviar formulário
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('loginForm').submit();
            }
        });
    </script>
</body>
</html>
