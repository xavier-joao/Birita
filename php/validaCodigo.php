<?php

require('config.php');

session_start();

$codigo = $_POST["codigo"];

$sessionId = $_SESSION["loggedIn"]["id"];
$status = $_SESSION["loggedIn"]["status"];


$verify = mysqli_query($conexao, "SELECT codVerificacao FROM usuario WHERE idUsuario = '$sessionId'");
$array = mysqli_fetch_array($verify);
$logarray = $array['codVerificacao'];


if (($logarray == $codigo) && ($status == 'autenticacaoLogin')) {
    $objeto['autenticacao'] = $status;
    echo json_encode($objeto);
} else if (($logarray == $codigo) && ($status == 'autenticacaoSenha')) {
    $objeto['autenticacao'] = $status;
    echo json_encode($objeto);
} else if (($logarray == $codigo) && ($status == 'validacaoUsuario')) {
    $ativaUsuario = mysqli_query($conexao, "UPDATE usuario SET ativo = 1 where idUsuario = '$logarray'");
    $objeto['autenticacao'] = $status;
    echo json_encode($objeto);
}


?>