<?php

require('config.php');

session_start();

$novaSenha = $_POST["novaSenhaHash"];


$sessionId = $_SESSION["loggedIn"]["id"];
$status = $_SESSION["loggedIn"]["status"];

$buscaId = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE idUsuario = '$sessionId'");
$array = mysqli_fetch_array($buscaId);
$logarray = $array['idUsuario'];

if ($logarray == $sessionId) {
    $alteraSenha = mysqli_query($conexao, "UPDATE usuario SET senha = '$novaSenha' where idUsuario = '$logarray'");
} else {
    echo "<script> alert('Deu ruim') </script>";
}

?>
