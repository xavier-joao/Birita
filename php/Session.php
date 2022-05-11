<?php 
    session_start();

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60*60*1800)) {

        session_unset();    
        session_destroy();  
    }

    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    $emailBD = "batata@batatinha.com";
    $senhaBD = "123456";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    die();

    if ($email == $emailBD && $senha == $senhaBD) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            if (empty($_SESSION['login'])){
                $_SESSION['login'] = $login;
            } else {
                echo "Usuario Logado: ".$_SESSION['login'];
            }
        }
    } else {
        echo "Login e senha incorretos";
    }   

?>

    

