<?php
// Inicia uma nova sessão ou retoma uma sessão existente
session_start();

// Inclui o arquivo usuarios.php que contém o array $usuarios com os hashes das senhas
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
    // Se existe uma chave com o nome do usuário no array $usuarios
    // Se a senha informada corresponde ao hash armazenado usando password_verify()
    if (isset($usuarios[$usuario]) && password_verify($senha, $usuarios[$usuario])) {
        
        // Armazena o nome do usuário na sessão para mantê-lo logado
        $_SESSION['usuario'] = $usuario;
        
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
    <!-- Define a codificação de caracteres como UTF-8 -->
    <meta charset="UTF-8">
    
    <!-- Define o título da página exibido na aba do navegador -->
    <title>Login com Hash</title>
</head>
<body>
    <!-- Título principal da página -->
    <h2>Login</h2>
    
    <!-- Verifica se a variável $erro contém algum valor (mensagem de erro) -->
    <?php if ($erro): ?>
        <!-- Exibe a mensagem de erro em vermelho -->
        <p style="color: red;"><?= $erro ?></p>
    <?php endif; ?>
    
    <!-- Formulário com método POST -->
    <form method="post" action="">
        <label>Usuário:</label><br>
        
        <!-- Campo de texto para entrada do nome de usuário, obrigatório -->
        <input type="text" name="usuario" required><br><br>
        
        <label>Senha:</label><br>
        
        <!-- Campo de senha (oculta os caracteres digitados), obrigatório -->
        <input type="password" name="senha" required><br><br>
        
        <!-- Botão de envio do formulário -->
        <button type="submit">Entrar</button>
    </form>
</body>
</html>