<?php
require '../includes/auth.php';
require '../config/db.php';
exigirLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome        = trim($_POST['nome']);
    $telefone    = trim($_POST['telefone']);
    $email       = trim($_POST['email']);
    $cidade      = trim($_POST['cidade']);
    $observacoes = trim($_POST['observacoes']);

    if ($nome !== '') {
        $stmt = $pdo->prepare(
            'INSERT INTO amigos (usuario_id, nome, telefone, email, cidade, observacoes)
             VALUES (?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $_SESSION['usuario_id'], $nome, $telefone, $email, $cidade, $observacoes
        ]);

        header('Location: listar.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Amigo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="caixa-form">
        <h1>Novo amigo</h1>
        <form method="POST">
            <label>Nome *</label>
            <input type="text" name="nome" required>

            <label>Telefone</label>
            <input type="text" name="telefone">

            <label>E-mail</label>
            <input type="email" name="email">

            <label>Cidade</label>
            <input type="text" name="cidade">

            <label>Observações</label>
            <textarea name="observacoes"></textarea>

            <button type="submit">Salvar</button>
        </form>
        <p><a href="listar.php">Voltar</a></p>
    </div>
</body>
</html>
