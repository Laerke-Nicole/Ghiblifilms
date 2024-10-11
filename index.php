<?php require_once("includes/session.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/library.css">
    <link rel="stylesheet" href="style/responsive.css">
</head>
<body>

<nav class="flex justify-between items-center p-6">
    <!-- empty div for left side alignment -->
    <div></div>

    <a href="index.php?page=home" class="secondary-color text-3xl caps">Ghiblifilms</a>

    <ul class="flex gap-6">
        
        <li><a href="index.php?page=login" class="secondary-color">Log in</a></li>
        <li><a href="index.php?page=newuser" class="secondary-color">New user</a></li>
        <li><a href="index.php?page=admin" class="secondary-color">Profile Page</a></li>

        <?php if (logged_in()) { ?>
            <form action="logout.php" method="post" style="display:inline;">
                <input type="submit" value="Log Out" class="btn">
            </form>
        <?php } ?>
    </ul>
</nav>



<?php
if (isset($_GET['page'])){
	$page = $_GET['page'];
	} else{
		$page = "index";}

switch($page) {

default:
    include('home.php');
break;

case "login":
    include('login.php');
break;

case "newuser":
    include('newuser.php');
break;

case "admin":
    include('crud/admin.php');
break;

// add
case "addentry":
    include('crud/addEntry.php');
break;

case "addnews":
    include('crud/addNews.php');
break;

// delete
case "deleteentry":
    include('crud/deleteEntry.php');
break;

case "deletenews":
    include('crud/deleteNews.php');
break;

// edit
case "editentry":
    include('crud/editEntry.php');
break;

case "editnews":
    include('crud/editNews.php');
break;

// update
case "updateentry":
    include('crud/updateEntry.php');
break;

case "updatenews":
    include('crud/updatenews.php');
break;

}  

?>



</body>
</html>