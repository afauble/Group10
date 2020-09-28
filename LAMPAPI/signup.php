<?php 
session_start(); 
//If user is logged in, go to the main page
if(isset($_POST['loggedIN'])) {
    header('Location: ../directed.php'); 
    exit();
}
//If the signup button is clicked
if(isset($_POST['login'])) {
    $conn = new mysqli('localhost', 'cop4331g_POOPTEN', '7[DaQeU,awcw', 'cop4331g_COP4331_Group_10');

    //Sanitize the username and password fields, for safety in database
    $user = $conn->real_escape_string($_POST['userPHP']);
    $pass = md5($conn->real_escape_string($_POST['passPHP']));

    //Search the usernames in database
    $data = $conn->query("SELECT ID FROM loginInfo WHERE username='$user'");
    
        //Check if username exists in table
        if($data->num_rows > 0) {
            exit('Username exists, try again!'); 
        }
        //Insert data into table
        else { 
        $data = $conn->query("INSERT INTO loginInfo (username, password) VALUES ('$user', '$pass')");
        if($data == false) {
            exit('Connection Error!');
        }
        else {
            exit('success');
        }
    }
}
else {
    exit('Failure');
}