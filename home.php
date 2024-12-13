<?php 
require_once ("includes/dbcon.php"); 
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
require_once("includes/connection.php"); 
// controllers
require_once("controllers/movieController.php");
require_once("controllers/companyController.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghiblifilms</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/library.css">
    <link rel="stylesheet" href="https://use.typekit.net/arj0iay.css">
</head>
<body>

<?php
// daily showings 
include("modules/homepage/showings.php");
   
// news 
include("modules/homepage/news.php");

// all movies 
include("modules/homepage/movies.php"); 

// about ghiblifilms
include("modules/homepage/about.php");

// contact form
include("modules/homepage/contactFormAndContactInfo.php");

// opening hours
include("modules/homepage/openingHours.php");

// company address
include("modules/homepage/address.php");

// venues/auditorium
include("modules/homepage/auditorium.php");
?>

</body>
</html>