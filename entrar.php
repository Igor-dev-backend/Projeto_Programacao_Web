<?php

session_start();
require 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['password'];

    if (empty($email) || empty($senha)) {
        $message = 'Preencha todos os campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'E-mail inválido.';
    } else {
        $stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            $_SESSION['user_email'] = $user['email'];
            header('Location: dashboard.php');
            exit;
        } else {
            $message = 'E-mail ou senha incorretos.';
        }
    }
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Entrar — MENU EXPRESS</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <header>
    <h1>Entrar</h1>
  </header>

  <main>
    <section aria-labelledby="login">
      <h2 id="login-title">Acesse sua conta</h2>

      <form action="login.php" method="post" novalidate>
        <div>
          <label for="login-email">E-mail</label>
          <input id="login-email" name="email" type="email" required autocomplete="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" />
        </div>

        <div>
          <label for="login-password">Senha</label>
          <input id="login-password" name="password" type="password" required autocomplete="current-password" />
        </div>

        <div>
          <input id="remember" name="remember" type="checkbox" />
          <label for="remember">Lembrar-me</label>
        </div>

        <div>
          <button type="submit">Entrar</button>
        </div>
      </form>

      <p>
        Não tem conta?
        <a href="register.php">Cadastre-se</a>
      </p>
    </section>
  </main>

  <footer>
    <small>© MENU EXPRESS</small>
  </footer>

  <script>
    
    function showNotification(message, type = 'error') {
      const notification = document.createElement('div');
      notification.textContent = message;
      notification.style.position = 'fixed';
      notification.style.top = '20px';
      notification.style.right = '20px';
      notification.style.padding = '15px 20px';
      notification.style.borderRadius = '4px';
      notification.style.color = 'white';
      notification.style.fontFamily = 'Arial, sans-serif';
      notification.style.fontSize = '1rem';
      notification.style.zIndex = '1000';
      notification.style.maxWidth = '300px';
      notification.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.3)';
      notification.style.opacity = '0';
      notification.style.transition = 'opacity 0.3s ease';
      notification.style.backgroundColor = type === 'success' ? '#FF4500' : '#CC3300';

      document.body.appendChild(notification);

      setTimeout(() => {
        notification.style.opacity = '1';
      }, 10);

      setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => {
          if (document.body.contains(notification)) {
            document.body.removeChild(notification);
          }
        }, 300);
      }, 5000);
    }

    
    <?php if ($message): ?>
      showNotification('<?php echo addslashes($message); ?>', 'error');
    <?php endif; ?>
  </script>
</body>
</html>
