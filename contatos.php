<?php
// Arquivo: contatos.php
// Gerencia a listagem, adição, edição e exclusão de contatos.

// 1. INCLUSÃO DE DEPENDÊNCIAS
require_once 'config.php'; // Inclui a conexão com o banco de dados

// Variáveis de estado
$mensagem = '';
$contato_editando = null;

// 2. LÓGICA DE PROCESSAMENTO (CRUD)

// --- AÇÃO DE EXCLUSÃO (DELETE) ---
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM contatos WHERE id = ?");
        $stmt->execute([$id]);
        $mensagem = '<div class="alert alert-success">Contato excluído com sucesso!</div>';
    } catch (PDOException $e) {
        $mensagem = '<div class="alert alert-danger">Erro ao excluir contato: ' . $e->getMessage() . '</div>';
    }
}

// --- AÇÃO DE EDIÇÃO (READ - para preencher o formulário) ---
if (isset($_GET['acao']) && $_GET['acao'] == 'editar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM contatos WHERE id = ?");
    $stmt->execute([$id]);
    $contato_editando = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contato_editando) {
        $mensagem = '<div class="alert alert-warning">Contato não encontrado.</div>';
    }
}

// --- AÇÃO DE INSERÇÃO/ATUALIZAÇÃO (CREATE/UPDATE) ---
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if (empty($nome) || empty($email)) {
        $mensagem = '<div class="alert alert-warning">Nome e E-mail são obrigatórios.</div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = '<div class="alert alert-warning">E-mail inválido.</div>';
    } else {
        try {
            if ($id) {
                // Atualizar (UPDATE)
                $stmt = $pdo->prepare("UPDATE contatos SET nome = ?, email = ?, telefone = ? WHERE id = ?");
                $stmt->execute([$nome, $email, $telefone, $id]);
                $mensagem = '<div class="alert alert-success">Contato atualizado com sucesso!</div>';
            } else {
                // Inserir (CREATE)
                $stmt = $pdo->prepare("INSERT INTO contatos (nome, email, telefone) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $email, $telefone]);
                $mensagem = '<div class="alert alert-success">Contato adicionado com sucesso!</div>';
            }
            // Limpa o formulário de edição após a operação
            $contato_editando = null; 
        } catch (PDOException $e) {
            // Verifica se é erro de duplicidade de e-mail
            if ($e->getCode() == 23000) {
                $mensagem = '<div class="alert alert-danger">Erro: O e-mail ' . htmlspecialchars($email) . ' já está cadastrado.</div>';
            } else {
                $mensagem = '<div class="alert alert-danger">Erro no banco de dados: ' . $e->getMessage() . '</div>';
            }
        }
    }
}

// --- AÇÃO DE LEITURA (READ - Listagem) ---
try {
    $stmt = $pdo->query("SELECT * FROM contatos ORDER BY nome ASC");
    $contatos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $mensagem = '<div class="alert alert-danger">Erro ao carregar contatos: ' . $e->getMessage() . '</div>';
    $contatos = [];
}

// 3. INÍCIO DA INTERFACE HTML
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Contatos</title>
    <!-- Incluindo Bootstrap (assumindo que você o usa) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Você pode incluir seu style.css aqui se necessário -->
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>

<?php include 'menu-publico.php'; // Inclui o menu de navegação ?>

<div class="container mt-5">
    <h1 class="mb-4">Gerenciamento de Contatos</h1>

    <?php echo $mensagem; // Exibe mensagens de sucesso ou erro ?>

    <!-- Formulário de Adição/Edição -->
    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <?php echo $contato_editando ? 'Editar Contato' : 'Adicionar Novo Contato'; ?>
        </div>
        <div class="card-body">
            <form method="POST" action="contatos.php">
                <?php if ($contato_editando ): ?>
                    <input type="hidden" name="id" value="<?php echo $contato_editando['id']; ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required value="<?php echo $contato_editando ? htmlspecialchars($contato_editando['nome']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required value="<?php echo $contato_editando ? htmlspecialchars($contato_editando['email']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $contato_editando ? htmlspecialchars($contato_editando['telefone']) : ''; ?>">
                </div>
                
                <button type="submit" class="btn btn-success">
                    <?php echo $contato_editando ? 'Salvar Alterações' : 'Adicionar Contato'; ?>
                </button>
                <?php if ($contato_editando): ?>
                    <a href="contatos.php" class="btn btn-secondary">Cancelar Edição</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Tabela de Listagem de Contatos -->
    <h2>Lista de Contatos</h2>
    <?php if (count($contatos) > 0): ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contatos as $contato): ?>
                    <tr>
                        <td><?php echo $contato['id']; ?></td>
                        <td><?php echo htmlspecialchars($contato['nome']); ?></td>
                        <td><?php echo htmlspecialchars($contato['email']); ?></td>
                        <td><?php echo htmlspecialchars($contato['telefone']); ?></td>
                        <td>
                            <a href="contatos.php?acao=editar&id=<?php echo $contato['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="contatos.php?acao=excluir&id=<?php echo $contato['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este contato?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Nenhum contato cadastrado.</div>
    <?php endif; ?>

</div>

<!-- Incluindo Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
