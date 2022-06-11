<?php 
include("config.php");
$query = "SELECT * FROM receita ORDER BY nomereceita DESC";
$r = mysqli_query($conexao,$query);
?>