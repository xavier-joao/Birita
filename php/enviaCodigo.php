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
$mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'smtp.gmail.com'; 
$mail->Port = 465;


$email = $_POST["emailLogin"];
$senha = $_POST["senhaHashLogin"];

$emailRecuperacao = $_POST["emailRecuperacao"];


    // Detalhes do envio de E-mail
$mail->Username = 'biritalovers@gmail.com'; 
$mail->Password = 'biritalovers14';
$mail->SetFrom('biritalovers@gmail.com', 'Birita');


$duration = 3600;

$verifyLogin = mysqli_query($conexao, "SELECT email,senha FROM usuario WHERE email = '$email' AND senha = '$senha'");
$verifyEmail = mysqli_query($conexao, "SELECT email FROM usuario WHERE email = '$emailRecuperacao'");

    if (mysqli_num_rows($verifyLogin) <= 0){
        echo"<script language='javascript' type='text/javascript'>
        alert('Email ou senha incorretos');window.location
        .href='indexLogin.html';</script>";
        die();
    }else{
        
        $buscaId = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE email = '$email'");
        $array = mysqli_fetch_array($buscaId);
        $logarray = $array['idUsuario'];


        $salvaCodigo = mysqli_query($conexao, "UPDATE usuario SET codVerificacao = '$randNum' where idUsuario = '$logarray'");
        $_SESSION["loggedIn"] = array(
            "start"=>time(),
            "duration"=>$duration,
            "id"=>$logarray,
            "status"=>'autenticacaoLogin'
        );
        $mail->addAddress($email,'');
          $mail->Subject = "Autenticaçâo de login";
          $mail->msgHTML('<h1>Seu código de verificação:</h1><br>' .$randNum);
          if($mail->send()){
            
          }
    }

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
        $mail->addAddress($email,'');
        $mail->Subject = "Recuperação de Senha";
        $mail->msgHTML('<h1>Seu código de verificação:</h1><br>' .$randNum);
        if($mail->send()){
            
        }
    }

      
?>