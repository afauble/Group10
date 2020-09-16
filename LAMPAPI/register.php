<?php 
include 'db.inc.php';

$sql = "INSERT INTO loginInfo (username, password) VALUES('".$_POST["username"]. "', '".$_POST["password"]."')"; 

$result = $conn->query($sql);
$conn->close();

