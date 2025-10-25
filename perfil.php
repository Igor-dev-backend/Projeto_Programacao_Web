<?php
session_start();
require_once 'config.php';

// Verificar se está logado
if (!isset($_SESSION['cliente_logado'])) {
    header('Location: login.php');
    exit;
}

$sucesso = '';
$erro = '';

// Processar atualização do perfil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');
    
    if (empty($nome)) {
        $erro = 'Nome é obrigatório!';
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, telefone = ?, endereco = ? WHERE id = ?");
            $stmt->execute([$nome, $telefone, $endereco, $_SESSION['cliente_id']]);
            
            $_SESSION['cliente_nome'] = $nome;
            $sucesso = 'Perfil atualizado com sucesso!';
        } catch (PDOException $e) {
            $erro = 'Erro ao atualizar perfil: ' . $e->getMessage();
        }
    }
}

// Buscar dados do usuário
try {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$_SESSION['cliente_id']]);
    $usuario = $stmt->fetch();
} catch (PDOException $e) {
    $erro = 'Erro ao carregar dados: ' . $e->getMessage();
    $usuario = [];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuExpress - Meu Perfil</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="admin/assets/css/admin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .profile-container {
            min-height: 100vh;
            background: #f5f6fa;
            padding: 2rem 0;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .profile-header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .profile-actions {
            margin-top: 1rem;
        }
        
        .profile-actions a {
            color: white;
            text-decoration: none;
            margin-right: 1rem;
            padding: 0.5rem 1rem;
            border: 1px solid white;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .profile-actions a:hover {
            background: white;
            color: #2c3e50;
        }
        
        .profile-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .profile-card h2 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
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
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e9ecef;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .form-group input[readonly] {
            background: #f8f9fa;
            color: #6c757d;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: #3498db;
            color: white;
        }
        
        .btn-primary:hover {
            background: #2980b9;
        }
        
        .btn-secondary {
            background: #95a5a6;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #7f8c8d;
        }
        
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .user-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .info-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
        }
        
        .info-item strong {
            color: #2c3e50;
        }
        
        @media (max-width: 768px) {
            .profile-container {
                padding: 1rem 0;
            }
            
            .profile-card {
                padding: 1.5rem;
            }
            
            .user-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <div class="container">
                <h1><i class="fas fa-user"></i> Meu Perfil</h1>
                <p>Gerencie suas informações pessoais</p>
                <div class="profile-actions">
                    <a href="index.php"><i class="fas fa-home"></i> Início</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </div>
            </div>
        </div>
        
        <div class="container">
            <?php if ($sucesso): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $sucesso; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($erro): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i> <?php echo $erro; ?>
                </div>
            <?php endif; ?>
            
            <!-- Informações do usuário -->
            <div class="profile-card">
                <h2><i class="fas fa-info-circle"></i> Informações da Conta</h2>
                <div class="user-info">
                    <div class="info-item">
                        <strong>Nome:</strong><br>
                        <?php echo htmlspecialchars($usuario['nome'] ?? ''); ?>
                    </div>
                    <div class="info-item">
                        <strong>Email:</strong><br>
                        <?php echo htmlspecialchars($usuario['email'] ?? ''); ?>
                    </div>
                    <div class="info-item">
                        <strong>Telefone:</strong><br>
                        <?php echo htmlspecialchars($usuario['telefone'] ?? 'Não informado'); ?>
                    </div>
                    <div class="info-item">
                        <strong>Membro desde:</strong><br>
                        <?php echo date('d/m/Y', strtotime($usuario['created_at'] ?? '')); ?>
                    </div>
                </div>
            </div>
            
            <!-- Formulário de edição -->
            <div class="profile-card">
                <h2><i class="fas fa-edit"></i> Editar Perfil</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="nome">Nome Completo *</label>
                        <input type="text" id="nome" name="nome" required 
                               value="<?php echo htmlspecialchars($usuario['nome'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" readonly
                               value="<?php echo htmlspecialchars($usuario['email'] ?? ''); ?>">
                        <small style="color: #666;">O email não pode ser alterado</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" name="telefone" 
                               placeholder="(11) 99999-9999"
                               value="<?php echo htmlspecialchars($usuario['telefone'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <textarea id="endereco" name="endereco" rows="3" 
                                  placeholder="Rua, número, bairro, cidade..."><?php echo htmlspecialchars($usuario['endereco'] ?? ''); ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        // Máscara para telefone
        document.getElementById('telefone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 11) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else if (value.length >= 7) {
                value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
            } else if (value.length >= 3) {
                value = value.replace(/(\d{2})(\d{0,5})/, '($1) $2');
            }
            e.target.value = value;
        });
    </script>
</body>
</html>
