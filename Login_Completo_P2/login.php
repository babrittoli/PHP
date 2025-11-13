<?php
    // Inicia sessão
    session_start();

    // Inclui o arquivo usuarios.php que tem o array $usuarios com os hash das senhas
    require 'usuarios.php';

    // Inicializa a variável $erro como string vazia para armazenar mensagens de erro
    $erro = '';

    // Verifica se a requisição HTTP foi feita através do método POST (envio do formulário)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Captura o valor do campo 'usuario' enviado via POST, ou string vazia se não existir
        $usuario = $_POST['usuario'] ?? '';
        
        // Captura o valor do campo 'senha' enviado via POST, ou string vazia se não existir
        $senha = $_POST['senha'] ?? '';
        
        // Verifica duas condições:
        // Se existe uma chave com o nome do usuário no array $usuarios e se a senha informada corresponde ao hash armazenado usando password_verify()
        if (isset($usuarios[$usuario]) && password_verify($senha, $usuarios[$usuario])) {
            
            // Armazena o nome do usuário na sessão para mantê-lo logado
            $_SESSION['usuario'] = $usuario;
            
            // Inclui o arquivo que envia notificação de acesso
            require 'notificacao_acesso.php';
            
            // Redireciona o usuário para a página home.php
            header('Location: home.php');
            
            // Encerra a execução do script após o redirecionamento
            exit;
            
        } else {
            // Define mensagem de erro caso as credenciais sejam inválidas
            $erro = 'Usuário ou senha inválidos!';
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2 class="text-primary mb-3">Login</h2>

        <!-- Verifica se a variável $erro contém algum valor (mensagem de erro) -->
        <?php if ($erro): ?>
            <!-- Exibe a mensagem de erro em vermelho -->
            <p class="text-danger"><?= $erro ?></p>
        <?php endif; ?>

        <!-- Formulário com método POST-->
        <form method="post" action="">
            <div class="mb-3 text-start">
                <label class="form-label">Usuário:</label>
                <!-- Campo do nome de usuário obrigatório -->
                <input type="text" name="usuario" class="form-control" required>
            </div>

            <div class="mb-3 text-start">
                <label class="form-label">Senha:</label>
                <!-- Campo de senha obrigatório -->
                <input type="password" name="senha" class="form-control" required>
            </div>

            <!-- Botão de envio do formulário -->
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>

        <br>
        <!-- ir pra Recuperação de senha -->
        <a href="esqueci_senha.php">Esqueci a Senha</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>