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
echo include("modules/homepage/showings.php");
   
// news 
echo include("modules/homepage/news.php");

// all movies 
echo include("modules/homepage/movies.php"); 

// about ghiblifilms
echo include("modules/homepage/about.php");

// contact form
echo include("modules/homepage/contactFormAndContactInfo.php");

// opening hours
echo include("modules/homepage/openingHours.php");

// company address
echo include("modules/homepage/address.php");

// venues/auditorium
echo include("modules/homepage/auditorium.php");
?>

</body>
</html>