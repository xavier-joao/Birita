<?php
require('config.php');

session_start();

$digits = 5;
$randNum = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

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
$mail->SMTPSecure = 'STARTTLS'; 
$mail->Host = 'smtp-mail.outlook.com'; 
$mail->Port = 587;



$emailRecuperacao = $_POST["emailRecuperacao"];


    // Detalhes do envio de E-mail
$mail->Username = 'biritalovers@hotmail.com'; 
$mail->Password = 'birita14';
$mail->SetFrom('biritalovers@hotmail.com', 'Birita Recuperação');


$duration = 3600;

$verifyEmail = mysqli_query($conexao, "SELECT email FROM usuario WHERE email = '$emailRecuperacao'");


    if (mysqli_num_rows($verifyEmail) <= 0){
        echo"<script language='javascript' type='text/javascript'>
        alert('Email incorreto ou não encontrado');window.location
        .href='indexLogin.html';</script>";
        die();
    }else{
        
        $buscaId = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE email = '$emailRecuperacao'");
        $array = mysqli_fetch_array($buscaId);
        $logarray = $array['idUsuario'];


        $salvaCodigo = mysqli_query($conexao, "UPDATE usuario SET codVerificacao = '$randNum' where idUsuario = '$logarray'");
        

        $_SESSION["loggedIn"] = array(
            "start"=>time(),
            "duration"=>$duration,
            "id"=>$logarray,
            "status"=>'autenticacaoSenha'
        );
        $mail->addAddress($emailRecuperacao,'');
        $mail->Subject = "Recuperação de Senha";
        $mail->msgHTML('<h1>Seu código de verificação:</h1><br>' .$randNum);
        if($mail->send()){
            echo"foi";
        } else {
          echo "caralhoooooo";
        }
    }

?>