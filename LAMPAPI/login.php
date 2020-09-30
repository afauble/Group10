<?php
session_start();
//If user is logged in, go to the main page
if(isset($_POST['loggedIN'])) {
    header('Location: ../directed.php');
    exit();
}

//If the login button is clicked
if(isset($_POST['login'])) {
    $conn = new mysqli('localhost', 'cop4331g_POOPTEN', '7[DaQeU,awcw', 'cop4331g_COP4331_Group_10');
    //Sanitize the username and password fields, for safety in database
    $user = $conn->real_escape_string($_POST['userPHP']);
    $pass = $conn->real_escape_string($_POST['passPHP']);
    //Search the username and password in database
    $data = $conn->query("SELECT ID FROM loginInfo WHERE username='$user' AND password='$pass'");

    if($conn->connect_error) {
        exit($conn->connect_error);
    }
     //If user exists in database....
    if($data->num_rows > 0) {
        $row = $data->fetch_assoc();
        $userID = $row["ID"];
        $_SESSION['loggedIN'] = '1';
        $_SESSION['user'] = $user;
        $_SESSION['userID'] = $userID;

        exit('success');
    } else
        exit('Can not login');
}
