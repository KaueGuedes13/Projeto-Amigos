<?php
require '../includes/auth.php';
require '../config/db.php';
exigirLogin();

$id = $_GET['id'] ?? null;

$stmt = $pdo->prepare('SELECT * FROM amigos WHERE id = ? AND usuario_id = ?');
$stmt->execute([$id, $_SESSION['usuario_id']]);
$amigo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$amigo) {
    header('Location: listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome        = trim($_POST['nome']);
    $telefone    = trim($_POST['telefone']);
    $email       = trim($_POST['email']);
    $cidade      = trim($_POST['cidade']);
    $observacoes = trim($_POST['observacoes']);

    $stmt = $pdo->prepare(
        'UPDATE amigos SET nome = ?, telefone = ?, email = ?, cidade = ?, observacoes = ?
         WHERE id = ? AND usuario_id = ?'
    );
    $stmt->execute([
        $nome, $telefone, $email, $cidade, $observacoes,
        $id, $_SESSION['usuario_id']
    ]);

    header('Location: listar.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Amigo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="caixa-form">
        <h1>Editar amigo</h1>
        <form method="POST">
            <label>Nome *</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($amigo['nome']) ?>" required>

            <label>Telefone</label>
            <input type="text" name="telefone" value="<?= htmlspecialchars($amigo['telefone']) ?>">

            <label>E-mail</label>
            <input type="email" name="email" value="<?= htmlspecialchars($amigo['email']) ?>">

            <label>Cidade</label>
            <input type="text" name="cidade" value="<?= htmlspecialchars($amigo['cidade']) ?>">

            <label>Observações</label>
            <textarea name="observacoes"><?= htmlspecialchars($amigo['observacoes']) ?></textarea>

            <button type="submit">Salvar alterações</button>
        </form>
        <p><a href="listar.php">Voltar</a></p>
    </div>
</body>
</html>
