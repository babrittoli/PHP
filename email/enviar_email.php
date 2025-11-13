<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Autoload do Composer

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email_destino = $_POST['email_destino'] ?? '';
    $assunto = $_POST['assunto'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'babrittolis@gmail.com';
        $mail->Password = 'vuwd bysn ziky dtkf'; // Senha de aplicativo gerado pelo gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Remetente e destinatário
        $mail->setFrom('babrittolis@gmail.com', 'Aula de PHP');
        $mail->addAddress($email_destino);

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = $assunto;
        //A função nl2br() no PHP é usada para converter quebras de linha (\n) a PHP de uma string.
        $mail->Body = nl2br($mensagem);

        //A função strip_tags() no PHP é usada para remover todas as tags HTML a PHP de uma string.
        $mail->AltBody = strip_tags($mensagem);

        //Enviar a mensagem
        $mail->send();
        echo 'Mensagem enviada com sucesso!';
    } catch (Exception $e) {
        echo "Erro ao enviar: {$mail->ErrorInfo}";
    }
} else {
    echo "Requisição inválida.";
}
?>