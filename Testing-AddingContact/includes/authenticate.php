<?php 

session_start(); 

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'dummytrial';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if(mysqli_connect_errno()) {
    exit('Failed to connect to the database: ' . mysql_connect_error());
}

//Error use cases --------------------

if(!isset($_POST['uid'], $_POST['pwd'])) {
    exit('Enter both your username and password');
}


//Add More if you want.... -------------


//Preventing SQL injection
if($stmt = $conn->prepare('SELECT id, pwd FROM accounts WHERE uid = ?')) {
    $stmt->bind_param('s', $_POST['uid']);
    $stmt->execute();
    $stmt->store_result(); 

    //If there are existing Users, execute the following:
    if($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password); 
        $stmt->fetch();

        if(password_verify($_POST['pwd'], $password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['uid'];
            $_SESSION['id'] = $id;
            header('Location: ../contact.php');
        } else 
            echo 'Incorrect password!';
    }
    else 
            echo 'Username doesn\'t exists';


    $stmt->close();
}
