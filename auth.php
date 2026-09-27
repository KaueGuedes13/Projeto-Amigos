<?php
session_start();

// Verifica se o usuário está logado; caso não esteja, redireciona para o login
function exigirLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ../login.php');
        exit;
    }
}

function usuarioLogado() {
    return isset($_SESSION['usuario_id']);
}
