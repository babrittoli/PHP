<?php
    // Inicia a sessão 
    session_start();

    // Verifica se a variável de sessão 'usuario' NÃO está definida
    if (!isset($_SESSION['usuario'])) {
        // Redireciona para a página de login se o usuário não estiver logado
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <!-- Mensagem de boas-vindas com o nome do usuário -->
            <h2 class="text-primary mb-3">Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']) ?>!</h2>

            <!-- Mensagem de área protegida -->
            <p class="mb-4">Você está na área protegida do sistema.</p>

            <!-- Botão de saída -->
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>