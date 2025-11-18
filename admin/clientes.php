<?php
session_start();
require_once '../config.php';

// Verificar se está logado como admin
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$sucesso = '';
$erro = '';

// Processar ações
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'reset_password':
                resetPassword($pdo);
                break;
            case 'delete_user':
                deleteUser($pdo);
                break;
        }
    }
}

// Função para redefinir senha
function resetPassword($pdo) {
    $id = $_POST['id'] ?? 0;
    $nova_senha = $_POST['nova_senha'] ?? '';
    
    if ($id <= 0 || empty($nova_senha)) {
        $_SESSION['message'] = 'Dados inválidos!';
        $_SESSION['message_type'] = 'error';
        return;
    }
    
    if (strlen($nova_senha) < 6) {
        $_SESSION['message'] = 'A senha deve ter pelo menos 6 caracteres!';
        $_SESSION['message_type'] = 'error';
        return;
    }
    
    try {
        $senhaHash = password_hash($nova_senha, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $stmt->execute([$senhaHash, $id]);
        $_SESSION['message'] = 'Senha redefinida com sucesso!';
        $_SESSION['message_type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Erro ao redefinir senha: ' . $e->getMessage();
        $_SESSION['message_type'] = 'error';
    }
}

// Função para excluir usuário
function deleteUser($pdo) {
    $id = $_POST['id'] ?? 0;
    
    if ($id <= 0) {
        $_SESSION['message'] = 'ID inválido!';
        $_SESSION['message_type'] = 'error';
        return;
    }
    
    try {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['message'] = 'Usuário excluído com sucesso!';
        $_SESSION['message_type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Erro ao excluir usuário: ' . $e->getMessage();
    }
}

// Buscar clientes
$search = $_GET['search'] ?? '';
$order_by = $_GET['order'] ?? 'created_at';
$order_dir = $_GET['dir'] ?? 'DESC';

$where_clause = '';
$params = [];

if (!empty($search)) {
    $where_clause = "WHERE nome LIKE ? OR email LIKE ?";
    $params = ["%$search%", "%$search%"];
}

try {
    $sql = "SELECT * FROM usuarios $where_clause ORDER BY $order_by $order_dir";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $clientes = [];
    $_SESSION['message'] = 'Erro ao carregar clientes: ' . $e->getMessage();
    $_SESSION['message_type'] = 'error';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuExpress - Gerenciar Clientes</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="admin-body">
    <header class="admin-header">
        <div class="container">
            <h1><i class="fas fa-users"></i> Gerenciar Clientes</h1>
            <div class="admin-actions">
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-utensils"></i> Cardápio
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

            <!-- Filtros e Busca -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-search"></i> Buscar Clientes</h2>
                </div>
                <div class="card-body">
                    <form method="GET" class="search-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="search">Buscar por nome ou email</label>
                                <input type="text" id="search" name="search" 
                                       value="<?php echo htmlspecialchars($search); ?>" 
                                       placeholder="Digite o nome ou email...">
                            </div>
                            <div class="form-group">
                                <label for="order">Ordenar por</label>
                                <select id="order" name="order">
                                    <option value="nome" <?php echo $order_by == 'nome' ? 'selected' : ''; ?>>Nome</option>
                                    <option value="email" <?php echo $order_by == 'email' ? 'selected' : ''; ?>>Email</option>
                                    <option value="created_at" <?php echo $order_by == 'created_at' ? 'selected' : ''; ?>>Data de Cadastro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dir">Direção</label>
                                <select id="dir" name="dir">
                                    <option value="ASC" <?php echo $order_dir == 'ASC' ? 'selected' : ''; ?>>Crescente</option>
                                    <option value="DESC" <?php echo $order_dir == 'DESC' ? 'selected' : ''; ?>>Decrescente</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                <a href="clientes.php" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Limpar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lista de Clientes -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-list"></i> Clientes Cadastrados (<?php echo count($clientes); ?>)</h2>
                </div>
                <div class="card-body">
                    <?php if (empty($clientes)): ?>
                        <div class="no-items">
                            <i class="fas fa-users"></i>
                            <h3>Nenhum cliente encontrado</h3>
                            <p><?php echo !empty($search) ? 'Tente ajustar os filtros de busca.' : 'Ainda não há clientes cadastrados.'; ?></p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>Cadastro</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clientes as $cliente): ?>
                                        <tr>
                                            <td><?php echo $cliente['id']; ?></td>
                                            <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                                            <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                                            <td><?php echo htmlspecialchars($cliente['telefone'] ?: 'Não informado'); ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($cliente['created_at'])); ?></td>
                                            <td class="actions-cell">
                                                <button class="btn btn-sm btn-warning" onclick="showResetPassword(<?php echo htmlspecialchars(json_encode($cliente)); ?>)">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                                <button class="btn btn-sm btn-info" onclick="showUserDetails(<?php echo htmlspecialchars(json_encode($cliente)); ?>)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo $cliente['id']; ?>, '<?php echo htmlspecialchars($cliente['nome']); ?>')">
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

    <!-- Modal para redefinir senha -->
    <div id="resetPasswordModal" class="modal">
        <div class="modal-content">
            <h3>Redefinir Senha</h3>
            <form id="resetPasswordForm" method="POST">
                <input type="hidden" name="action" value="reset_password">
                <input type="hidden" name="id" id="resetUserId">
                
                <div class="form-group">
                    <label>Cliente:</label>
                    <input type="text" id="resetUserName" readonly>
                </div>
                
                <div class="form-group">
                    <label for="nova_senha">Nova Senha *</label>
                    <input type="password" id="nova_senha" name="nova_senha" required minlength="6">
                </div>
                
                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Nova Senha *</label>
                    <input type="password" id="confirmar_senha" required minlength="6">
                </div>
                
                <div class="modal-actions">
                    <button type="submit" class="btn btn-primary">Redefinir Senha</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('resetPasswordModal')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para detalhes do usuário -->
    <div id="userDetailsModal" class="modal">
        <div class="modal-content">
            <h3>Detalhes do Cliente</h3>
            <div id="userDetailsContent"></div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('userDetailsModal')">Fechar</button>
            </div>
        </div>
    </div>

    <!-- Modal de confirmação para exclusão -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Confirmar Exclusão</h3>
            <p id="deleteMessage">Tem certeza que deseja excluir este cliente?</p>
            <form id="deleteForm" method="POST" style="display: none;">
                <input type="hidden" name="action" value="delete_user">
                <input type="hidden" name="id" id="deleteUserId">
            </form>
            <div class="modal-actions">
                <button class="btn btn-danger" onclick="confirmDelete()">Sim, Excluir</button>
                <button class="btn btn-secondary" onclick="closeModal('deleteModal')">Cancelar</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
    <script src="assets/js/admin.js"></script>
    <script>
        // Redefinir senha
        function showResetPassword(cliente) {
            document.getElementById('resetUserId').value = cliente.id;
            document.getElementById('resetUserName').value = cliente.nome + ' (' + cliente.email + ')';
            document.getElementById('resetPasswordModal').style.display = 'block';
        }

        // Detalhes do usuário
        function showUserDetails(cliente) {
            const content = `
                <div class="user-details">
                    <p><strong>ID:</strong> ${cliente.id}</p>
                    <p><strong>Nome:</strong> ${cliente.nome}</p>
                    <p><strong>Email:</strong> ${cliente.email}</p>
                    <p><strong>Telefone:</strong> ${cliente.telefone || 'Não informado'}</p>
                    <p><strong>Endereço:</strong> ${cliente.endereco || 'Não informado'}</p>
                    <p><strong>Cadastrado em:</strong> ${new Date(cliente.created_at).toLocaleString('pt-BR')}</p>
                    <p><strong>Última atualização:</strong> ${new Date(cliente.updated_at).toLocaleString('pt-BR')}</p>
                </div>
            `;
            document.getElementById('userDetailsContent').innerHTML = content;
            document.getElementById('userDetailsModal').style.display = 'block';
        }

        // Excluir usuário
        function deleteUser(id, nome) {
            document.getElementById('deleteUserId').value = id;
            document.getElementById('deleteMessage').textContent = `Tem certeza que deseja excluir o cliente "${nome}"? Esta ação não pode ser desfeita.`;
            document.getElementById('deleteModal').style.display = 'block';
        }

        // Confirmar exclusão
        function confirmDelete() {
            document.getElementById('deleteForm').submit();
        }

        // Fechar modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Validação do formulário de redefinir senha
        document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
            const senha = document.getElementById('nova_senha').value;
            const confirmar = document.getElementById('confirmar_senha').value;
            
            if (senha !== confirmar) {
                e.preventDefault();
                alert('As senhas não coincidem!');
                return;
            }
            
            if (senha.length < 6) {
                e.preventDefault();
                alert('A senha deve ter pelo menos 6 caracteres!');
                return;
            }
        });

        // Fechar modais ao clicar fora
        window.onclick = function(event) {
            const modals = ['resetPasswordModal', 'userDetailsModal', 'deleteModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (event.target === modal) {
                    closeModal(modalId);
                }
            });
        }
    </script>
</body>
</html>
