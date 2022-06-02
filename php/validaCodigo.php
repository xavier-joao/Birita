<?php

require('config.php');

$codigo = $_POST["codigo"];

$sessionEmail = $_SESSION["loggedIn"][2];
$verify = mysqli_query($conexao, "SELECT codVerificacao FROM usuario WHERE email = '$sessionEmail'") or die("erro ao selecionar");
$array = mysqli_fetch_array($verify);
$logarray = $array['codVerificacao'];

if ($logarray == $codigo)
    echo "<script> alert('Deu bom') </script>";
else {
    echo "<script> alert('Deu ruim') </script>";
}
?>