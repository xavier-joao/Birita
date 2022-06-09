<?php
require('config.php');
session_start();

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
$mail->SMTPSecure = 'tls'; 
$mail->Host = 'smtp-mail.outlook.com'; 
$mail->Port = 587;

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senhaHash"];

$query_select = "SELECT email FROM usuario WHERE email = '$email'";
$select = mysqli_query($conexao,$query_select);
$array = mysqli_fetch_array($select);
$logarray = $array['email'];




    // Detalhes do envio de E-mail
$mail->Username = 'biritalovers@hotmail.com'; 
$mail->Password = 'birita14';
$mail->SetFrom('biritalovers@hotmail.com', 'Birita');
    

if($logarray == $email){
    $objeto['status'] = 'emailCadastrado';
    echo json_encode($objeto);
    

  }else {
    $queryInsertUsuario = "INSERT INTO usuario(nome, email, senha) VALUES ('$nome', '$email', '$senha');";
    $insertUsuario = mysqli_query($conexao, $queryInsertUsuario);

    if($insertUsuario){
        $buscaId = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE email = '$email'");
        $array = mysqli_fetch_array($buscaId);
        $logarray = $array['idUsuario'];
        
        $_SESSION["loggedIn"] = array(
            "start"=>time(),
            "duration"=>$duration,
            "id"=>$logarray,
            "status"=>'confirmacaoEmail'
        );


    $mail->addAddress($email,'');
    $mail->Subject = "Confirmação de E-mail";
    $mail->msgHTML("
    <html>
    <head>
    <meta charset='UTF-8' />
    <title>Email</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            border: 0;
        }

        body {
            font-family: 'helvetica', sans-serif;
            background-color: #f3faf7;
            font-size: 19px;
            max-width: 800px;
            margin: 0 auto;
            padding: 3%;
        }

        img {
            max-width: 100%;
        }

        header {
            width: 98%;
        }

        #logo {
            display: block;
            text-align: center;
            max-width: 200px;
            margin: 3% auto 3% auto;  
        }

        #header {
            background-color: #f3faf7;
        }

        #container {
            display: grid;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
            height: 160vh;
            max-width: 800px;
            background: linear-gradient(to right, #9B4FE3, #3AB9CF);
        }

        #social-links {
            text-align: center;
            margin: 3% 2% 4% 3%;
        }

        #social-links  img {
            max-width: 35px;
            max-height: 35px;
            padding: 4px;
        }

        .gif {
            margin: 0 auto 3% auto;
        }

        h1 {
            font-size: 30px;
            font-weight: bolder;
            text-transform: lowercase;
            text-align: center;
            color: #f3faf7;
            margin: 3%;
        }
        
        p {
            font-family: 'helvetica';
            font-size: 20px;
            font-weight: lighter;
            text-align: center;
            color: #f3faf7;
            margin: 3%;
        }

        hr {
            height: 1px;
            background-color: #f3faf7;
            clear: both;
            width: 96%;
            margin: auto;
        }

        .btn {
            display: block;
            border-radius: 12px;
            text-transform: uppercase;
            background-color: transparent;
            color: #f3faf7;
            font-size: 16px;
            padding: 10px;
            cursor: pointer;
            font-family: 'helvetica';
            font-weight: bold;
            width: 300px;
            height: 70px;
            align-self: center;
            align-items: center;
            border: 2px solid #f3faf7;
            margin:3% auto 3% auto;
        }

        .btn:hover {
            background-color: #f3faf7;
            color: #3ab9cf;
            align-items: center;
            cursor: pointer;
        }
    </style>
    </head>
    <body>
    <div id='header'>
        <header>
        <div id='logo'>
            <img src='img/logo.png'>
        </div>
        </header>
        <div id='container'>
        <div>
            <h1>Seja muito bem-vindo a família Biriter!</h1>
            <p>
                Ahhhhhh estamos muito felizes em ter você aqui com a gente, já estamos com o nosso drink pronto para brindarmos! E para isso só está 
                faltando uma coisa: confirmar o seu email :) é só clicar no botão que está aqui embaixo!
            </p>
            <a href='http://localhost/Birita/index.html'>
                <button class='btn' type='button'>Confirmar email</button>
            </a>
                        
        </div>
        <div class='gif'>
            <img src='https://media.giphy.com/media/hTAX5rJYx90DpeRsKc/giphy.gif'>
        </div>
        <hr />
            <footer>
                <div id='social-links'>
                    <img src='https://iconscout.com/icon-editor?state=XQAAAAKuAAAAAAAAAABt__34xfyFByjbQKgxfXKAYgiEvQYu0UB3AINXI2TQZUeacyuCXHcwLmuQd_kfLOwv6_wCGamQmX7o9s1qMLKACUHjGnsEMVJz3tq5-hq4ZBCysmVC3ACX6EIOMsL9cj3Buuv5uBz4VRo3U0nM3JlRR2JsC0ARqLZaOexcylUQ3RFRJJndlk0gd1Z8PEF5glO6eqr7u0mnU1n7PtZlZNH03EGP9jT5vVMA '>
                    <img src='https://iconscout.com/icon-editor?state=XQAAAAK-AAAAAAAAAABt__34xfyFByjbQKgxfXKAYgiEvQYu0UB3AINXI2TQZUeacyuCXHcwLmuQd_kfLOwv6_wCGamQmX7o9s1qMLTY5aoC6Hr7c-xuD4UhlAroZA02J0NKKgBL9xu-j3pNmAHDZE5XdLeZRbAc4y6QFdh73bFFy44HM5nyyp58avPkkQfH23kSwNv1V1AyveuEVx0sTGVCtG56V02tnRAYW3ilxuklr-RsAoTRtWDFgQHIbPvwlyT7RvSA '>
                    <img src='https://iconscout.com/icon-editor?state=XQAAAAK-AAAAAAAAAABt__34xfyFByjbQKgxfXKAYgiEvQYu0UB3AINXI2TQZUeacyuCXHcwLmuQd_kfLOwv6_wCGamQmX7o9s1qMLTY5aoC6Hr7c-xuD4UhlAroZA02J0NKKgBL9xu-j3pNmAHDZE5XdLeZRbAc4y6QFdh73bFFy44HM5nyyp58avPkkQfH23kSwNv1V1Ayve6z7DiIxlKB50SnQZ0jHtiagGaWDhgXBo4gka5k_Dz9BPuxwFlkcP-gNkAA '>
                </div>
            </footer>
        </div>
    </div>
    </body>
    </html>");
    if($mail->send()) {
        $objeto['status'] = 'sucesso';
    echo json_encode($objeto);   
    }
    }
  }