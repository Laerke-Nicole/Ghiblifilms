<?php 
require_once ("includes/dbcon.php"); 
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
require_once("includes/connection.php"); 
// controllers
require_once("controllers/adminController.php");
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

<section>
    <?php
    // hero 
    include("modules/homepage/hero.php"); 

    // intro text
    include("modules/homepage/introText.php");

    // all movies 
    include("modules/homepage/movies.php"); 

    // all content blocks
    include("modules/homepage/contentBlock.php");

    // news 
    include("modules/homepage/news.php"); 

    
    // highlighted movie
    include("modules/homepage/highlightMovie.php"); 

    
    // collage section
    include("modules/homepage/collage.php"); ?>
</section>

</body>
</html>