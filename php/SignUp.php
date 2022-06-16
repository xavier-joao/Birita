<?php
require('config.php');
session_start();

$digits = 5;
$randNum = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$duration = 3600;

error_reporting(0);

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

$criptografia = $_POST['mensagem'];

$iv = substr($criptografia,0, 32);
$cifrado = substr($criptografia,32);

$chave = '1234567887654321';

$mensagem_decrypt = openssl_decrypt($cifrado, 'aes-128-cbc', $chave, OPENSSL_ZERO_PADDING, $iv);

$json = json_decode(trim($mensagem_decrypt));

$nome = $json->nome;
$email = $json->email;
$senha = $json->senha;

$query_select = "SELECT email FROM usuario WHERE email = '$email'";

$select = mysqli_query($conexao,$query_select);
$array = mysqli_fetch_array($select);



    // Detalhes do envio de E-mail
$mail->Username = 'biritalovers@hotmail.com'; 
$mail->Password = 'birita14';
$mail->SetFrom('biritalovers@hotmail.com', 'Birita');
    
if(!empty($array)){
    $objeto['status'] = 'emailCadastrado';
    echo json_encode($objeto);
    

} else {
   
    $queryInsertUsuario = "INSERT INTO usuario(nome, email, senha, ativo, codVerificacao) VALUES ('$nome', '$email', '$senha', 0, '$randNum');";
    
    $insertUsuario = mysqli_query($conexao, $queryInsertUsuario);

    
    if($insertUsuario){
        $mail->addAddress($email,'');
        $mail->Subject = "Confirmação de email";
            $mail->msgHTML('<h1>Seu código de verificação:</h1><br>' .$randNum);
        if($mail->send()) {

            $buscaId = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE email = '$email'");
            $array = mysqli_fetch_array($buscaId);
            $logarray = $array['idUsuario'];

            $salvaCodigo = mysqli_query($conexao, "UPDATE usuario SET codVerificacao = '$randNum' where idUsuario = '$logarray'");

            $_SESSION["loggedIn"] = array(
                "start"=>time(),
                "duration"=>60*60*1800,
                "id"=>$logarray,
                "status"=>'validacaoUsuario',
                "nome"=>$nome
            );
            $objeto['status'] = 'sucesso';
            echo json_encode($objeto);   
        }
    }
}   
?>