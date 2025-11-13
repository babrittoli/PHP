<?php
// Inicia a sessão
session_start();

// Verifica se a variável de sessão 'usuario' NÃO está definida
if (!isset($_SESSION['usuario'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: login.php');
    // Interrompe a execução do script para evitar o carregamento da página
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área Restrita</title>
</head>
<body>
    <!-- Exibe uma mensagem de boas-vindas com o nome do usuário armazenado na sessão -->
    <h2>Bem-vindo, <?= $_SESSION['usuario'] ?>!</h2>

    <!-- Mensagem informando que o usuário está em uma área protegida -->
    <p>Você está na área protegida do sistema.</p>

    <!-- Sair -->
    <a href="logout.php">Sair</a>
</body>
</html>
