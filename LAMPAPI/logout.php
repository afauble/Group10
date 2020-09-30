<?php
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["username"]);
    header("location: ../logging.php?logout=true");
    exit();

?>
