<?php
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["username"]);
    header("location: ../index.php?logout=true");
    exit();

?>
