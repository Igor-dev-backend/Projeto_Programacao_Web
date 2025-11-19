<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'config.php';

$stmt = $pdo->query("SELECT id, nome, email FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <title>Dashboard — MENU EXPRESS</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <header>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
    <a href="logout.php">Logout</a>
  </header>

  <main>
    <h2>Lista de Usuários Cadastrados</h2>
    <table border="1">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $usuario): ?>
          <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
            <td>
              <a href="edit.php?id=<?php echo $usuario['id']; ?>">Editar</a> |
              <a href="delete.php?id=<?php echo $usuario['id']; ?>" onclick="return confirm('Tem certeza?')">Deletar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <footer>
    <small>© MENU EXPRESS</small>
  </footer>

  
</body>
</html>
