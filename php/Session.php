<?php
    require('config.php');
    session_start();

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60*60*1800)) {

        session_unset();    
        session_destroy();  
    }

    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    $emailBD = $_POST["emailLogin"];
    $senhaBD = $_POST["senhaHash"];

    $query_select = "SELECT email,senha FROM usuario WHERE email = '$emailBD' AND senha='$senhaBD'";
    $select = mysqli_query($conexao,$query_select);

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    die();

    if ($email == $emailBD && $senha == $senhaBD) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            if (empty($_SESSION['login'])){
                $_SESSION['login'] = $login;
                echo "<script>alertaModal('Login realizado com sucesso')</script>"
            } else {
                echo "Usuario Logado: ".$_SESSION['login'];
            }
        }
    } else {
        echo"<script>
        alertaModal('Login incorreto tente novamente');
        var email = document.getElementById('email').value = "";
        var senha = document.getElementById('senha').value = "";
    </script>"
        echo "Login e senha incorretos";
    }   

?>

    

