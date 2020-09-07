<?php

session_start();

if(!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="images/contact.png">
</head>
<body>
<header>
    <h1>Contact System</h1>
    <a href="logout.php" id = "lout">Log Out</a>
</header>

<main>
<div class = "CreateContactForm">
    <ul>
        <li><input type="text" name="fname" placeholder="First Name"></li>
        <li><input type="text" name="lname" placeholder="Last Name"></li>
        <li><input type="text" name="email" placeholder="E-mail Address"></li>
        <li><input type="text" name="mobilenum" placeholder="Phone-Number"></li>
        <li><input type="text" name="address" placeholder="Physical Address"></li>
    </ul>
    <button type="button">Create Contact</button>
    <button type="button">Cancel</button>
</div>
</main>
</body>
</html>