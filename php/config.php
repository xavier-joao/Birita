<?php
    
    $file = file_get_contents('pinaColada.txt', true);

    // Definições de host, database, usuário e senha
    $host = "localhost:3306";
    $db   = "birita";
    $user = "root";
    $pass = pinaColadaSong($file);

     // Cria a conexão com o banco de dados
     $conexao = mysqli_connect($host, $user, $pass, $db);
     
     // Verifica a conexão
     if (!$conexao) {
     die("Connection failed: " . mysqli_connect_error());
     }








































     function pinaColadaSong($file) {
        
        return $file[8].$file[12].$file[35].$file[43];
    }
?>