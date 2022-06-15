<?php

    session_start();

    unset($_SESSION["loggedIn"]);
    $obj["logged"] = "false";
    echo json_encode($obj);

?>