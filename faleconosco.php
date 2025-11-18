<?php
// ============================================
// PÁGINA FALE CONOSCO
// ============================================

// Iniciar a sessão para manter a consistência, embora não seja estritamente necessário para esta página
session_start();

// Conectar ao banco de dados (para manter a consistência com outras páginas)
require_once 'config.php';

// Variáveis para armazenar o status da mensagem (se o formulário fosse funcional)
$mensagem_status = '';

// Lógica de processamento do formulário (simulada, pois não há backend completo)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aqui seria a lógica para enviar o email ou salvar no banco de dados
    // Por enquanto, apenas uma mensagem de sucesso simulada
    $mensagem_status = '<div class="alert success">Mensagem enviada com sucesso! Em breve entraremos em contato.</div>';
}

// Verifica se o cliente está logado para exibir o menu correto
$cliente_logado = isset($_SESSION['cliente_logado']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fale Conosco - MenuExpress</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilos básicos para o formulário de contato, para garantir que apareça bem */
        .contact-form-container {
            max-width: 600px;
            margin: 3rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .contact-form-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }
        .btn-submit {
            display: block;
            width: 100%;
            padding: 0.75rem;
            background-color: #007bff; /* Cor primária, assumindo um padrão */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
            text-align: center;
        }
        .alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="header-left">
                    <?php include 'logo.php'; ?>
                    <p style="margin-top: 0.5rem;">Estamos aqui para te ouvir</p>
                </div>
                <div class="header-right">
                    <?php if ($cliente_logado): ?>
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
            <div class="contact-form-container">
                <h2>Entre em Contato</h2>
                <?php echo $mensagem_status; ?>
                <form action="faleconosco.php" method="POST">
                    <div class="form-group">
                        <label for="nome">Seu Nome:</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Seu E-mail:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="assunto">Assunto:</label>
                        <input type="text" id="assunto" name="assunto" required>
                    </div>
                    <div class="form-group">
                        <label for="mensagem">Mensagem:</label>
                        <textarea id="mensagem" name="mensagem" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Enviar Mensagem</button>
                </form>
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