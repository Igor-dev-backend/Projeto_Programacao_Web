<?php
session_start();
require_once '../config.php';

// Verificar se está logado (sistema simples de autenticação)
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Processar ações
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                addPrato($pdo);
                break;
            case 'edit':
                editPrato($pdo);
                break;
            case 'delete':
                deletePrato($pdo);
                break;
        }
    }
}

// Função para adicionar prato
function addPrato($pdo) {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $imagem = $_POST['imagem'] ?? '';
    
    if (empty($nome) || empty($descricao) || $preco <= 0) {
        $_SESSION['message'] = 'Preencha todos os campos obrigatórios!';
        $_SESSION['message_type'] = 'error';
        return;
    }
    
    try {
        $stmt = $pdo->prepare("INSERT INTO pratos (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $descricao, $preco, $imagem]);
        $_SESSION['message'] = 'Prato adicionado com sucesso!';
        $_SESSION['message_type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Erro ao adicionar prato: ' . $e->getMessage();
        $_SESSION['message_type'] = 'error';
    }
}

// Função para editar prato
function editPrato($pdo) {
    $id = $_POST['id'] ?? 0;
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $imagem = $_POST['imagem'] ?? '';
    
    if (empty($nome) || empty($descricao) || $preco <= 0 || $id <= 0) {
        $_SESSION['message'] = 'Preencha todos os campos obrigatórios!';
        $_SESSION['message_type'] = 'error';
        return;
    }
    
    try {
        $stmt = $pdo->prepare("UPDATE pratos SET nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?");
        $stmt->execute([$nome, $descricao, $preco, $imagem, $id]);
        $_SESSION['message'] = 'Prato atualizado com sucesso!';
        $_SESSION['message_type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Erro ao atualizar prato: ' . $e->getMessage();
        $_SESSION['message_type'] = 'error';
    }
}

// Função para excluir prato
function deletePrato($pdo) {
    $id = $_POST['id'] ?? 0;
    
    if ($id <= 0) {
        $_SESSION['message'] = 'ID inválido!';
        $_SESSION['message_type'] = 'error';
        return;
    }
    
    try {
        $stmt = $pdo->prepare("DELETE FROM pratos WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['message'] = 'Prato excluído com sucesso!';
        $_SESSION['message_type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Erro ao excluir prato: ' . $e->getMessage();
        $_SESSION['message_type'] = 'error';
    }
}

// Buscar todos os pratos
try {
    $stmt = $pdo->query("SELECT * FROM pratos ORDER BY nome ASC");
    $pratos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $pratos = [];
    $_SESSION['message'] = 'Erro ao carregar pratos: ' . $e->getMessage();
    $_SESSION['message_type'] = 'error';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuExpress - Painel Administrativo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="admin-body">
    <header class="admin-header">
        <div class="container">
            <h1><i class="fas fa-cog"></i> Painel Administrativo</h1>
            <div class="admin-actions">
                <a href="clientes.php" class="btn btn-info">
                    <i class="fas fa-users"></i> Clientes
                </a>
                <a href="../" class="btn btn-secondary" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Ver Site
                </a>
                <a href="logout.php" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>
    </header>

    <main class="admin-main">
        <div class="container">
            <!-- Mensagens -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php 
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
                ?>
            <?php endif; ?>

            <!-- Formulário para adicionar/editar prato -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-plus"></i> Adicionar Novo Prato</h2>
                </div>
                <div class="card-body">
                    <form id="pratoForm" method="POST">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="id" id="editId">
                        
                        <div class="form-group">
                            <label for="nome">Nome do Prato *</label>
                            <input type="text" id="nome" name="nome" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="descricao">Descrição *</label>
                            <textarea id="descricao" name="descricao" rows="3" required></textarea>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="preco">Preço (R$) *</label>
                                <input type="number" id="preco" name="preco" step="0.01" min="0" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="imagem">URL da Imagem</label>
                                <input type="url" id="imagem" name="imagem" placeholder="https://exemplo.com/imagem.jpg">
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Salvar Prato
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="clearForm()">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lista de pratos -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-list"></i> Pratos Cadastrados (<?php echo count($pratos); ?>)</h2>
                </div>
                <div class="card-body">
                    <?php if (empty($pratos)): ?>
                        <div class="no-items">
                            <i class="fas fa-utensils"></i>
                            <h3>Nenhum prato cadastrado</h3>
                            <p>Adicione o primeiro prato usando o formulário acima.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Imagem</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Preço</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pratos as $prato): ?>
                                        <tr>
                                            <td>
                                                <?php if (!empty($prato['imagem'])): ?>
                                                    <img src="<?php echo htmlspecialchars($prato['imagem']); ?>" 
                                                         alt="<?php echo htmlspecialchars($prato['nome']); ?>" 
                                                         class="table-image">
                                                <?php else: ?>
                                                    <div class="no-image-small">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($prato['nome']); ?></td>
                                            <td class="description-cell">
                                                <?php echo htmlspecialchars(substr($prato['descricao'], 0, 50)) . (strlen($prato['descricao']) > 50 ? '...' : ''); ?>
                                            </td>
                                            <td class="price-cell">R$ <?php echo number_format($prato['preco'], 2, ',', '.'); ?></td>
                                            <td class="actions-cell">
                                                <button class="btn btn-sm btn-warning" onclick="editPrato(<?php echo htmlspecialchars(json_encode($prato)); ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deletePrato(<?php echo $prato['id']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal de confirmação para exclusão -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Confirmar Exclusão</h3>
            <p>Tem certeza que deseja excluir este prato?</p>
            <div class="modal-actions">
                <button class="btn btn-danger" onclick="confirmDelete()">Sim, Excluir</button>
                <button class="btn btn-secondary" onclick="closeModal()">Cancelar</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
    <script src="assets/js/admin.js"></script>
</body>
</html>
