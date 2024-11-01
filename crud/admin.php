<?php require_once "dbcon.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin page</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/ghiblifilms/style/style.css">
    <link rel="stylesheet" href="/ghiblifilms/style/responsive.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>
<!-- Buttons to toggle each section -->
<button class="btn" onclick="toggleSection('movieAdmin')">Movie</button>
<button class="btn" onclick="toggleSection('userAdmin')">User</button>
<button class="btn" onclick="toggleSection('newsAdmin')">News</button>

<!-- Movie Admin Section -->    
<div id="movieAdmin" style="display: none;">
    <?php require 'adminModules/movieAdmin.php'; ?>
</div>

<!-- User Admin Section -->
<div id="userAdmin" style="display: none;">
    <?php require 'adminModules/userAdmin.php'; ?>
</div>

<!-- News Admin Section -->
<div id="newsAdmin" style="display: none;">
    <?php require 'adminModules/newsAdmin.php'; ?>
</div>

</body>
</html>