<?php
require '../includes/auth.php';
require '../config/db.php';
exigirLogin();

$stmt = $pdo->prepare('SELECT * FROM amigos WHERE usuario_id = ? ORDER BY nome');
$stmt->execute([$_SESSION['usuario_id']]);
$amigos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meus Amigos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="topo">
        <h1>Meus Amigos</h1>
        <div>
            Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?> |
            <a href="../logout.php">Sair</a>
        </div>
    </header>

    <main class="conteudo">
        <a href="criar.php" class="botao">+ Novo amigo</a>

        <table class="tabela">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Cidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($amigos) === 0): ?>
                    <tr><td colspan="5">Nenhum amigo cadastrado ainda.</td></tr>
                <?php endif; ?>

                <?php foreach ($amigos as $amigo): ?>
                    <tr>
                        <td><?= htmlspecialchars($amigo['nome']) ?></td>
                        <td><?= htmlspecialchars($amigo['telefone']) ?></td>
                        <td><?= htmlspecialchars($amigo['email']) ?></td>
                        <td><?= htmlspecialchars($amigo['cidade']) ?></td>
                        <td>
                            <a href="editar.php?id=<?= $amigo['id'] ?>">Editar</a> |
                            <a href="excluir.php?id=<?= $amigo['id'] ?>"
                               onclick="return confirm('Excluir este amigo?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
