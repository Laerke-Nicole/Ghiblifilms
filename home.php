<?php 
require_once ("includes/dbcon.php"); 
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
require_once("includes/connection.php"); 

// get daily showings from db
$queryShowings = $dbCon->prepare("SELECT * FROM DailyShowingsView");
$queryShowings->execute();
$dailyShowingsViews = $queryShowings->fetchAll();


// get news from db
$queryNews = $dbCon->prepare("SELECT * FROM News");
$queryNews->execute();
$getNews = $queryNews->fetchAll();


// get movies from db
$queryMovies = $dbCon->prepare("SELECT MovieID, `Name`, MovieImg FROM Movie");
$queryMovies->execute();
$getMovies = $queryMovies->fetchAll();


// get about ghiblifilms from db
$queryAboutCompany = $dbCon->prepare("SELECT NameOfCompany, CompanyDescription FROM CompanyInformation");
$queryAboutCompany->execute();
$getAboutCompany = $queryAboutCompany->fetchAll();


// get company info from db
$queryCompanyInformation = $dbCon->prepare("SELECT CompanyEmail, CompanyPhoneNumber FROM CompanyInformation");
$queryCompanyInformation->execute();
$getCompanyInformation = $queryCompanyInformation->fetchAll();


// get opening hours  from db 
$queryOpeningHour = $dbCon->prepare("SELECT `Day`, `Time` FROM OpeningHour");
$queryOpeningHour->execute();
$getOpeningHour = $queryOpeningHour->fetchAll();


// get view with company address info from db
$queryCompanyAddressView = $dbCon->prepare("SELECT *
                                            FROM CompanyAddressView");
$queryCompanyAddressView->execute();
$getCompanyAddressView = $queryCompanyAddressView->fetchAll();


// get auditorium/venues from db
$queryAuditorium = $dbCon->prepare("SELECT AuditoriumNumber
                                    FROM Auditorium");
$queryAuditorium->execute();
$getAuditorium = $queryAuditorium->fetchAll();
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