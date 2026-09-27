<?php
require 'includes/auth.php';
require 'config/db.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // password_verify compara a senha digitada com o hash salvo no banco
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id']   = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];

        header('Location: amigos/listar.php');
        exit;
    } else {
        $erro = 'E-mail ou senha inválidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Entrar - Cadastro de Amigos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="caixa-form">
        <h1>Entrar</h1>

        <?php if (isset($_GET['registrado'])): ?>
            <p class="mensagem-sucesso">Conta criada com sucesso! Faça login.</p>
        <?php endif; ?>

        <?php if ($erro): ?>
            <p class="mensagem-erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>E-mail</label>
            <input type="email" name="email" required>

            <label>Senha</label>
            <input type="password" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
        <p><a href="registrar.php">Criar conta</a></p>
    </div>
</body>
</html>
