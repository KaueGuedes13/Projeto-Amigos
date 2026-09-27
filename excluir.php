<?php
require '../includes/auth.php';
require '../config/db.php';
exigirLogin();

$id = $_GET['id'] ?? null;

$stmt = $pdo->prepare('DELETE FROM amigos WHERE id = ? AND usuario_id = ?');
$stmt->execute([$id, $_SESSION['usuario_id']]);

header('Location: listar.php');
exit;
