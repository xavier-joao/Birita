<?php

    session_start();

    unset($_SESSION["loggedIn"]);
    
    //header('Location: index.php');

    $obj["logged"] = "false";

    //echo("<script>location.href('index.html');</script>");

    echo json_encode($obj);

?>