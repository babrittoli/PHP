<?php
// Inicia a sessão para poder acessá-la e depois destruí-la
session_start();

// Encerra a sessão atual, removendo todas as variáveis salvas
session_destroy();

// Redireciona o usuário de volta para a página de login
header('Location: login.php');

// Interrompe a execução do script após o redirecionamento
exit;
?>
