<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../PHPMailer-master/src/Exception.php';
    require '../PHPMailer-master/src/PHPMailer.php';
    require '../PHPMailer-master/src/SMTP.php';
    $mail = new PHPMailer();
    // Configuração
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->IsSMTP(); 
$mail->CharSet = 'UTF-8';   
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;     
$mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'smtp.gmail.com'; 
$mail->Port = 465;
    // Detalhes do envio de E-mail
$mail->Username = 'ghostsoftcompany@gmail.com'; 
$mail->Password = 'ghostcompany';
$mail->SetFrom('ghostsoftcompany@gmail.com', 'Birita');
    $mail->addAddress('joaopx82@gmail.com','');
$mail->Subject = "Confirmação de E-mail";
$mail->msgHTML("blablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablabla");
    $mail->send();
?>