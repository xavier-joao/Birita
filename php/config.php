<?php
    // Definições de host, database, usuário e senha
    $host = "localhost:3306";
    $db   = "birita";
    $user = "root";
    $pass = "";

     // Cria a conexão com o banco de dados
     $conexao = mysqli_connect($host, $user, $pass, $db);
     
     // Verifica a conexão
     if (!$conexao) {
     die("Connection failed: " . mysqli_connect_error());
     }

?>