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
$queryMovies = $dbCon->prepare("SELECT * FROM Movie");
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
$queryOpeningHour = $dbCon->prepare("SELECT * FROM OpeningHour");
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


<!-- daily showings -->
<?php
if ($dailyShowingsViews) {
    echo '<section class="pt-24 ten-percent" id="daily-showings">';
        echo '<h2 class="text-center pb-4">Daily Showings</h2>';
        echo '<div class="items">';
            foreach ($dailyShowingsViews as $showings) { 
                echo '<div>';
                    echo "<img src='upload/" . htmlspecialchars(trim($showings['MovieImg'])) . "' alt='Image of movie'>";
                    echo '<h5 class="weight-400 pb-2">' . htmlspecialchars(trim($showings['Name'])) . '</h5>';
                    echo '<button class="btn" onclick="window.location.href=\'index.php?page=moviedetail&ID=' . htmlspecialchars(trim($showings['MovieID'])) . '\'">Get tickets</button>';
                echo '</div>';
            }
        echo '</div>';
    echo '</section>';
}
?>  
   

<!-- news -->
<section class="pt-24 pb-24 ten-percent" id="news">
    <div>
        <?php echo '<h2 class="text-center pb-4">NEWS</h2>';?>
    </div>
    
    <!-- loop with news -->
    <div class="items">
        <?php
            foreach ($getNews as $news) {
                echo '<div>';
                    echo "<img src='upload/" . htmlspecialchars(trim($news['NewsImg'])) . "' alt='Image of news'>";
                    echo '<h5 class="weight-400 pb-2">' . htmlspecialchars(trim($news['Headline'])) . '</h5>';
                    echo '<button class="btn" onclick="window.location.href=\'index.php?page=newsdetail&ID=' . htmlspecialchars(trim($news['NewsID'])) . '\'">See more</button>';
                echo '</div>';
            }
        ?>
    </div>

</section>


<!-- upcoming movies -->
<section class="pb-24 ten-percent" id="movies">
    <div>
        <?php echo '<h2 class="text-center pb-4">Upcoming movies</h2>';?>
    </div>
    
    <!-- loop with movies -->
    <div class="items">
        <?php
        foreach ($getMovies as $getMovie) { 
            echo '<div>';
            echo "<img src='upload/" . htmlspecialchars(trim($getMovie['MovieImg'])) . "' alt='Image of movie'>";
            echo '<h5 class="weight-400 pb-2">' . htmlspecialchars(trim($getMovie['Name'])) . '</h5>';
            echo '<button class="btn" onclick="window.location.href=\'index.php?page=moviedetail&ID=' . htmlspecialchars(trim($getMovie['MovieID'])) . '\'">Get tickets</button>';
            echo '</div>';
        }
        ?>
    </div>

</section>


<!-- about ghiblifilms -->
<section id="about-us">
    <div class="about-ghiblifilms flex pt-20 pb-20 justify-around">
        <?php
            foreach ($getAboutCompany as $about) {
                echo '<div class="flex-1 max-w-xs">';
                    echo '<h2 class="primary-color text-6xl">About<br>' . htmlspecialchars(trim($about['NameOfCompany'])) . '</h2>';
                echo '</div>';

                echo '<div class="flex-1 max-w-lg">';
                    echo '<p class="primary-color primary-font text-lg">' . htmlspecialchars(trim($about['CompanyDescription'])) . '</p>';
                echo '</div>';
            }
        ?>
    </div>    
</section>


<!-- contact form -->
<section class="ten-percent pt-24 pb-24">
    <?php echo '<h1 class="text-3xl weight-400 pb-12">Contact us with any questions</h1>';?>

    <!-- contact form -->
    <div class="flex gap-4">
        <!-- display contact form -->
        <?php require 'modules/contactform/form.php' ?>
        

        <!-- contact info -->
        <div class="w-half">
            <div class="box">
                
                <?php echo '<h3 class="text-xl pb-4">Prefer a direct contact? You can reach us via email or phone:</h3>';?>
                
                <div class="flex flex-col gap-6">
                    <?php
                        foreach ($getCompanyInformation as $companyInfo) {
                            echo '<div>';
                                echo '<h4 class="text-sm">Email us</h4>';
                                echo '<p>' . htmlspecialchars(trim($companyInfo['CompanyEmail'])) . '</p>';
                            echo '</div>';
                            echo '<div>';
                                echo '<h4 class="text-sm">Call us</h4>';
                                echo '<p>' . htmlspecialchars(trim($companyInfo['CompanyPhoneNumber'])) . '</p>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- opening hours -->
<section>
    <div class="ten-percent pb-24">
        <?php       
            echo '<h5>Opening hours:</h5>';
            foreach ($getOpeningHour as $openingHour) {
                echo '<div>';
                    echo '<p class="text-sm">' . htmlspecialchars(trim($openingHour['Day'])) . '</p>';
                    echo '<p class="pb-4 text-sm">' . htmlspecialchars(trim($openingHour['Time'])) . '</p>';
                echo '</div>';
            }
        ?>
    </div>
</section>

<!-- company address -->
<section>
<!-- display company address info -->
<div class="ten-percent pb-24">
    
    <?php    
    foreach ($getCompanyAddressView as $companyAddress) {
        echo "<h5>Find ". htmlspecialchars(trim($companyAddress['NameOfCompany'])) . " address:</h5>";
        echo "<div>";
            echo "<p>". htmlspecialchars(trim($companyAddress['StreetName'])) . "</p>";
            echo "<p>". htmlspecialchars(trim($companyAddress['StreetNumber'])) . "</p>";
        echo "</div>";

        echo "<div>";
            echo "<p>". htmlspecialchars(trim($companyAddress['PostalCode'])) . "</p>";
            echo "<p>". htmlspecialchars(trim($companyAddress['City'])) . "</p>";
            echo "<p>". htmlspecialchars(trim($companyAddress['Country'])) . "</p>";
            echo "<p>". htmlspecialchars(trim($companyAddress['City'])) . "</p>";
        echo "</div>";
    }
    ?>
</div>
</section>


<!-- venues/auditorium -->
<section>
<!-- display info -->
<div class="ten-percent pb-24">
    
    <?php    
        echo "<h5>All our venues:</h5>";
        echo "<div>";
            foreach ($getAuditorium as $auditorium) {
                echo "<p>". htmlspecialchars(trim($auditorium['AuditoriumNumber'])) . "</p>";
            }
        echo "</div>";
    ?>
</div>
</section>

</body>
</html>