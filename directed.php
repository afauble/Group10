<?php
session_start(); 

if(isset($_POST['loggedIN'])) {
    header('Location: directed.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Manager | Universal-Contact-Filing</title>
        <link rel="icon" href="images/knighticon.png">

        <!-- Bootstrap css -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- JQuery and Bootstrap scripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>

        <!-- Link to css and js-->
        <link rel="stylesheet" href="./css/style2.css">

        <!-- Font Awesome for icons -->
        <script src="https://kit.fontawesome.com/0c1bbd3644.js" crossorigin="anonymous"></script>

        <!-- javscript for functionality -->
        <script type="text/javascript">  var uid = "<?php echo $_SESSION['userID'] ?>";</script>
        <script src="js/directed.js"></script>
    </head>
    <body>

        <div class="fixed-top">
            <div class="container-fluid">
        <!-- UCF Heading and Add Button-->
                <div class="ucfheading">
                    <span class="ucftext">U</span><span class="normaltext">niversal</span>&nbsp;&nbsp;
                    <span class="ucftext">C</span><span class="normaltext">ontact</span>&nbsp;&nbsp;
                    <span class="ucftext">F</span><span class="normaltext">iling</span>
                    <button class="btn add-button" onclick="displayAddTable()" id="btn add-button"><i class="fas fa-plus"></i></button>
                </div>
            </div>
        </div>

        <!-- Top Nav Bar with Search Bar and Log Out Button -->
        <nav class="navbar navbar-expand-md fixed-top" style="background-image: linear-gradient(to right, black, rgb(184, 164, 105)) ">
            <div class="container-fluid">

                <div class="search-bar-form">
                    <input id="searchbar" type="text" class="nav-item" placeholder="Search...">
                    <!-- Add searchForContacts() method -->
                    <button id="searchbtn" type="button" class="btn nav-item search-button"><i class="fas fa-search"></i></button>
                </div>

                <a button href ="LAMPAPI/logout.php" name="logout" id="logout" type="button" class="btn nav-item logout-button"><i class="fas fa-sign-out-alt"></i> Log Out</button></a>

            </div>
        </nav>



     <div class="typicalList"> <div class="listedTables" id="listedTables"> </div> </div>

     <div class="shadowAdd">
        <div id="dvTable" class="dvTable">
            <button class="btn close-button" onclick="closeTable()" ><i class="fas fa-minus"></i></button>
        <table>
            <form>
                <tr>
                    <td class="tb-fn"><input class="fill-in" type="text" placeholder="First Name" id="fn" name="firstNameInput" ></td>
                    <td class="tb-email"><input class="fill-in" type="text" placeholder="Email Address" id="em" name="emailAddressInput" ></td>
                    <td class="tb-date">DateCreated</td>
                </tr>
                <tr>
                    <td class="tb-ln"><input class="fill-in" type="text" placeholder="Last Name" id="ln" name="lastNameInput"></td>
                    <td class="tb-addr"><input class="fill-in" type="text" placeholder="Phone-Number" id="pn" name="phoneNumber"></td>
                    <td class="tb-delete">
                        <button type="submit" class="btn add-button-check" onclick="addContacts()" id="addContact"><i class="fas fa-check"></i></button>
                    </td>
                </tr>
            </form>
        </table>
    </div>
</div>

    </body>
</html>
