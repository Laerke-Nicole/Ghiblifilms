<?php 
require_once ("includes/dbcon.php");
require_once("includes/session.php"); 
require_once("includes/functions.php");
//confirm_logged_in(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/showCategory.js" defer></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
            padding: 20px;
        }
        .sidenav {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #ffffff;
        }
        .content-area {
            margin-left: 250px; 
            padding: 20px;
            flex: 1;
        }
        .category-section {
            display: none;
        }
        .card {
            cursor: pointer;
            background-color: var(--secondary-color);
        }
        .content {
            margin-left: 250px;
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><a href="#!" onclick="showCategory('movie')">Movies</a></li>
        <li><a href="#!" onclick="showCategory('company')">Company</a></li>
        <li><a href="#!" onclick="showCategory('user')">Users</a></li>
        <li><a href="#!" onclick="showCategory('address')">Address</a></li>
    </ul>

    <!-- Main Content -->
    <main class="content-area">
        <?php include("modules/admin/categories.php"); ?>
    </main>

    <!-- display the added ones and add new -->
    <div class="content">
        <?php include("modules/admin/createAndAdded.php"); ?>
    </div>

</body>
</html>