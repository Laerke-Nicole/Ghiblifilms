<?php 
require_once("includes/connection.php");
require_once ("includes/dbcon.php");
require_once("includes/functions.php");
require_once ("includes/csrfProtection.php");
// controllers
require_once("controllers/movieController.php");
require_once("controllers/companyController.php");
require_once("controllers/userController.php");
require_once("controllers/addressController.php");
require_once("controllers/reservationsController.php");

confirm_logged_in();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/showCategory.js" defer></script>
    <script src="js/dropdown.js" defer></script>
    <style>
        
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><a href="#!" onclick="showCategory('movie')">Movies</a></li>
        <li><a href="#!" onclick="showCategory('company')">Company</a></li>
        <li><a href="#!" onclick="showCategory('user')">Users</a></li>
        <li><a href="#!" onclick="showCategory('address')">Address</a></li>
        <li><a href="#!" onclick="showCategory('reservation')">Reservations</a></li>
    </ul>

    <!-- Main Content -->
    <main class="content-area">
        <?php include("modules/admin/categories.php"); ?>
    </main>

    <!-- display the added ones and add new -->
    <div class="ml-250">
        <?php include("modules/admin/createAndAdded.php"); ?>
    </div>

</body>
</html>