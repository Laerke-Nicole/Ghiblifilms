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
    <!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Le5im4qAAAAABvcp4E5XaeQ54PjcD-9ql3pq5nF"></script>
    <script src="js/recaptcha.js" defer></script>
</head>
<body>

<?php
// daily showings 
include("modules/homepage/showings.php");
   
// news 
include("modules/homepage/news.php");

// all movies 
include("modules/homepage/movies.php"); 

// contact form
include("modules/homepage/contactFormAndContactInfo.php");

?>

</body>
</html>