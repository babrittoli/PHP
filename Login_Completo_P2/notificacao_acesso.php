<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Autoload do Composer

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
    $mail->addAddress('marcos.sousa12@fatec.sp.gov.br'); 

    // Data e hora do acesso - peguei da documentação com o horário de são paulo mesmo. 
    date_default_timezone_set('America/Sao_Paulo');
    $data_hora = date('d/m/Y H:i:s');

    // Mensagem de notificação de acesso com hora e data
    $mensagem_notificacao = "Um acesso foi realizado com sucesso.\n\nUsuário: {$usuario}\nData e Hora: {$data_hora}";

    // Conteúdo da mensagem de e-mail
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';  // Para não quebrar os caracteres especiais 
    $mail->Subject = 'Acesso bem sucedido ao Sistema';
    $mail->Body = nl2br($mensagem_notificacao);
    
    // strip_tags(): usada para remover todas as tags HTML de uma string
    $mail->AltBody = strip_tags($mensagem_notificacao);

    $mail->send();
} catch (Exception $e) {
    //Se de erro não interrompe o fluxo do login
    error_log("Erro ao enviar notificação: {$mail->ErrorInfo}");
}
?>