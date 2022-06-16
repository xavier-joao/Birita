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

$email = $_POST["emailLogin"];
$senha = $_POST["senhaHashLogin"];


    // Detalhes do envio de E-mail
$mail->Username = 'biritalovers@hotmail.com'; 
$mail->Password = 'birita14';
$mail->SetFrom('biritalovers@hotmail.com', 'Birita');

$buscaAtivo = mysqli_query($conexao, "SELECT ativo FROM usuario WHERE email = '$email'");
$arrayStatus = mysqli_fetch_array($buscaAtivo);
$logarrayStatus = $arrayStatus['ativo'];

$duration = 3600;

$verify = mysqli_query($conexao, "SELECT email,senha FROM usuario WHERE email = '$email' AND senha = '$senha'") or die("erro ao selecionar");

    if (mysqli_num_rows($verify) <= 0){
        $objeto['statusLogin'] = 'usuarioInvalido';
        echo json_encode($objeto);
    }else{
        if($logarrayStatus == 0) {
            $buscaId = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE email = '$email'");
            $array = mysqli_fetch_array($buscaId);
            $logarray = $array['idUsuario'];

            $salvaCodigo = mysqli_query($conexao, "UPDATE usuario SET codVerificacao = '$randNum' where idUsuario = '$logarray'");
            $NameSearch = mysqli_query($conexao, "SELECT nome FROM usuario WHERE idusuario = '$logarray'");
            $name = mysqli_fetch_array($NameSearch);
            $_SESSION["loggedIn"] = array(
                "start"=>time(),
                "duration"=>$duration,
                "id"=>$logarray,
                "status"=>'validacaoUsuario',
                "nome"=>$name
            );

            $mail->addAddress($email,'');
            $mail->Subject = "Confirmação de email";
            $mail->msgHTML('<h1>Seu código de verificação:</h1><br>' .$randNum);
            if($mail->send()){
                $objeto['statusLogin'] = 'verificacaoUsuario';
                echo json_encode($objeto);
            } else {
                echo "erro usuário inativo";
            }
        } else if ($logarrayStatus == 1) {
            $buscaId = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE email = '$email'");
            $array = mysqli_fetch_array($buscaId);
            $logarray = $array['idUsuario'];
            $NameSearch = mysqli_query($conexao, "SELECT nome FROM usuario WHERE idusuario = '$logarray'");
            $name = mysqli_fetch_array($NameSearch);
            $salvaCodigo = mysqli_query($conexao, "UPDATE usuario SET codVerificacao = '$randNum' where idUsuario = '$logarray'");
            $_SESSION["loggedIn"] = array(
                "start"=>time(),
                "duration"=>$duration,
                "id"=>$logarray,
                "status"=>'autenticacaoLogin',
                "nome"=>$name
            );
            
            $mail->addAddress($email,'');
            $mail->Subject = "Autenticaçâo de login";
            $mail->msgHTML('<h1>Seu código de verificação:</h1><br>' .$randNum);
            if($mail->send()){
                $objeto['statusLogin'] = 'sucesso';
                echo json_encode($objeto);
            } else {
                echo "erro usuário ativo";
            }
        } 
      }
?>