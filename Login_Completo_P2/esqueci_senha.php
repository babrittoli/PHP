<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Autoload do Composer

// Array com emails mocados
$emails_cadastrados = [
    'barbara.santos74@fatec.sp.gov.br',
    'marcos.sousa12@fatec.sp.gov.br'
];

// Inicializa variáveis para mensagens
$mensagem = '';
$sucesso = false;

// Verifica se a requisição HTTP foi feita através do método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Captura o valor do campo 'email' enviado via POST
    $email = $_POST['email'] ?? '';
    
    // Verifica se o email existe no array de emails cadastrados
    if (in_array($email, $emails_cadastrados)) {
        
        $mail = new PHPMailer(true);
        
        try {
            // Configurações do servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'babrittolis@gmail.com'; 
            $mail->Password = 'vuwd bysn ziky dtkf'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Remetente e destinatário
            $mail->setFrom('babrittolis@gmail.com', 'Sistema de Login');
            $mail->addAddress($email);

            // Conteúdo
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8'; // Para não quebrar os caracteres especiais 
            $mail->Subject = 'Recuperação de Senha';
            
            // Mensagem de recuperação
            $mensagem_recuperacao = "Sua senha foi resetada com sucesso.\n\nSua nova senha temporária é: Fatec2025SI\n\nPor favor, altere sua senha após o primeiro acesso.";
            
            // A função nl2br() no PHP é usada para converter quebras de linha em tags HTML <br>
            $mail->Body = nl2br($mensagem_recuperacao);
            
            // A função strip_tags() no PHP é usada para remover todas as tags HTML
            // de uma string
            $mail->AltBody = strip_tags($mensagem_recuperacao);

            $mail->send();
            $mensagem = 'E-mail de recuperação enviado com sucesso!';
            $sucesso = true;
            
        } catch (Exception $e) {
            $mensagem = "Erro ao enviar e-mail: {$mail->ErrorInfo}";
        }
        
    } else {
        $mensagem = 'E-mail não encontrado no sistema!';
    }
}
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Esqueci a Senha</title>

        <!-- Importa o Bootstrap via CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Link CSS -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <h2 class="text-primary mb-3">Recuperação de Senha</h2>

            <!-- Verifica se existe mensagem para exibir -->
            <?php if ($mensagem): ?>
                <!-- Exibe a mensagem em verde se sucesso, vermelho se erro -->
                <p class="<?= $sucesso ? 'text-success' : 'text-danger' ?>"><?= $mensagem ?></p>
            <?php endif; ?>

            <!-- Formulário -->
            <form method="post" action="">
                <div class="mb-3 text-start">
                    <label class="form-label">E-mail de Cadastro:</label>
                    <!-- Campo de email, obrigatório -->
                    <input type="email" name="email" class="form-control" required>
                </div>

                <!-- Botão de envio do formulário -->
                <button type="submit" class="btn btn-primary w-100">Recuperar Senha</button>
            </form>

            <br>
            <!-- Voltar à página de login -->
            <a href="login.php">Voltar para o Login</a>
        </div>

        <!-- Link do Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>