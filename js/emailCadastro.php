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
$mail->Username = 'loverbirita@gmail.com'; 
$mail->Password = 'Biriters555';
$mail->SetFrom('loversbirita@gmail.com', 'Birita');
    $mail->addAddress('marcella14peralta14@gmail.com','');
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

      #gif {
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
              Ahhhhhh estamos muito feliz em ter você aqui com a gente, já estamos com o nosso drink pronto para brindarmos! E para isso só está 
              faltando uma coisa: confirmar o seu email :) é só clicar no botão que está aqui embaixo!
          </p>
          <button class='btn' type='button' onclick='location.href="index.html"'>Confirmar email</button>          
      </div>
      <div id='gif'>
          <img src='img/betty-white-wine.gif'>
      </div>
      <hr />
          <footer>
              <div id='social-links'>
                  <img src='img/facebook.png'>
                  <img src='img/twitter.png'>
                  <img src='img/instagram.png'>
              </div>
          </footer>
    </div>
  </div>
</body>
</html>

");
    $mail->send();
?>