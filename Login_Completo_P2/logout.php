
<?php
// Inicia a sessão
session_start();

// Encerra a sessão atual removendo as váriaveis
session_destroy();

// Redireciona para a página de login
header('Location: login.php');

// Interrompe a execução do script após o redirecionamento
exit;
?>