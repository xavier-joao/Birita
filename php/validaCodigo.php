<?php

require('config.php');

$codigo = $_POST["codigo"];

$sessionId = $_SESSION["loggedIn"][2];
$status = $_SESSION["loggedIn"][3];
$verify = mysqli_query($conexao, "SELECT codVerificacao FROM usuario WHERE email = '$sessionId'");
$array = mysqli_fetch_array($verify);
$logarray = $array['codVerificacao'];

if (($logarray == $codigo) && ($status == 'autenticacaoLogin')) {
    $objeto['status'] = $status;
    echo json_encode($objeto);
} else {
    if (($logarray == $codigo) && ($status == 'autenticacaoSenha')) {
        $objeto['status'] = $status;
        echo json_encode($objeto);
    } 
}
?>