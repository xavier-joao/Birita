<?php

require('config.php');

$novaSenha = $_POST["novaSenhaHash"];

$sessionId = $_SESSION["loggedIn"][2];
$buscaId = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE email = '$sessionId'");
$array = mysqli_fetch_array($buscaId);
$logarray = $array['idUsuario'];

if ($logarray == $sessionId) {
    $alteraSenha = mysqli_query($conexao, "UPDATE usuario SET senha = '$novaSenha' where idUsuario = '$logarray'");
} else {
    echo "<script> alert('Deu ruim') </script>";
}

?>
