<?php

$serverName = "localhost";
$username = "cop4331g_POOPTEN";
$password = "7[DaQeU,awcw";
$dbName = "cop4331g_COP4331_Group_10";

$conn = new mysqli($serverName, $username, $password, $dbName);

if($conn->connect_error) {
    die("Failed to connect " .$conn->connect_error);
}