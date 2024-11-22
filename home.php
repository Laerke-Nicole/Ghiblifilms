<?php require_once ("includes/dbcon.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>

<?php
// connect to db
$dbCon = dbCon($user, $pass);
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


<!-- daily premieres -->
<?php
$queryPremieres = $dbCon->prepare("SELECT * FROM DailyPremieres");
$queryPremieres->execute();
$dailyPremieres = $queryPremieres->fetchAll();

if ($dailyPremieres) {
    echo '<section class="pt-24 ten-percent">';
        echo '<h2 class="text-center pb-4">Daily Premieres</h2>';
        echo '<div class="items">';
            foreach ($dailyPremieres as $premiere) { 
                echo '<div>';
                    echo "<img src='upload/" . $premiere['MovieImg'] . "' alt='Image of movie'>";
                    echo '<h5 class="weight-400 pb-2">' . $premiere['Name'] . '</h5>';
                    echo '<button class="btn" onclick="window.location.href=\'index.php?page=moviedetail&ID=' . $premiere['MovieID'] . '\'">Get tickets</button>';
                echo '</div>';
            }
        echo '</div>';
    echo '</section>';
}
?>  
   

<!-- news -->
<section class="pt-24 pb-24 ten-percent">
    <div>
        <?php echo '<h2 class="text-center pb-4">NEWS</h2>';?>
    </div>
    
    <!-- loop with news -->
    <div class="items">
        <?php
            $dbCon = dbCon($user, $pass);
            $queryNews = $dbCon->prepare("SELECT * FROM News");
            $queryNews->execute();
            $getNews = $queryNews->fetchAll();

            foreach ($getNews as $news) {
                echo '<div>';
                    echo "<img src='upload/" . $news['NewsImg'] . "' alt='Image of news'>";
                    echo '<h5 class="weight-400 pb-2">' . $news['Headline'] . '</h5>';
                    echo '<button class="btn" onclick="window.location.href=\'index.php?page=newsdetail&ID=' . $news['NewsID'] . '\'">See more</button>';
                echo '</div>';
            }
        ?>
    </div>

</section>


<!-- upcoming movies -->
<section class="pb-24 ten-percent">
    <div>
        <?php echo '<h2 class="text-center pb-4">Upcoming movies</h2>';?>
    </div>
    
    <!-- loop with movies -->
    <div class="items">
        <?php
        $dbCon = dbCon($user, $pass);
        $queryMovies = $dbCon->prepare("SELECT * FROM Movie");
        $queryMovies->execute();
        $getMovies = $queryMovies->fetchAll();

        foreach ($getMovies as $getMovie) { 
            echo '<div>';
            echo "<img src='upload/" . $getMovie['MovieImg'] . "' alt='Image of movie'>";
            echo '<h5 class="weight-400 pb-2">' . $getMovie['Name'] . '</h5>';
            echo '<button class="btn" onclick="window.location.href=\'index.php?page=moviedetail&ID=' . $getMovie['MovieID'] . '\'">Get tickets</button>';
            echo '</div>';
        }
        ?>
    </div>

</section>


<!-- about ghiblifilms -->
<section>
    <div class="about-ghiblifilms flex pt-20 pb-20 justify-around">
        <?php
            $dbCon = dbCon($user, $pass);
            $queryCompanyInformation = $dbCon->prepare("SELECT NameOfCompany, CompanyDescription FROM CompanyInformation");
            $queryCompanyInformation->execute();
            $getCompanyInformation = $queryCompanyInformation->fetchAll();

            foreach ($getCompanyInformation as $companyInfo) {
                echo '<div class="flex-1 max-w-xs">';
                    echo '<h2 class="primary-color text-6xl">About<br>' . $companyInfo['NameOfCompany'] . '</h2>';
                echo '</div>';

                echo '<div class="flex-1 max-w-lg">';
                    echo '<p class="primary-color primary-font text-lg">' . $companyInfo['CompanyDescription'] . '</p>';
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
                        $dbCon = dbCon($user, $pass);
                        $queryCompanyInformation = $dbCon->prepare("SELECT CompanyEmail, CompanyPhoneNumber FROM CompanyInformation");
                        $queryCompanyInformation->execute();
                        $getCompanyInformation = $queryCompanyInformation->fetchAll();

                        foreach ($getCompanyInformation as $companyInfo) {
                            echo '<div>';
                                echo '<h4 class="text-sm">Email us</h4>';
                                echo '<p>' . $companyInfo['CompanyEmail'] . '</p>';
                            echo '</div>';
                            echo '<div>';
                                echo '<h4 class="text-sm">Call us</h4>';
                                echo '<p>' . $companyInfo['CompanyPhoneNumber'] . '</p>';
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
            $queryOpeningHour = $dbCon->prepare("SELECT * FROM OpeningHour");
            $queryOpeningHour->execute();
            $getOpeningHour = $queryOpeningHour->fetchAll();

            echo '<h5>Opening hours:</h5>';
            foreach ($getOpeningHour as $openingHour) {
                echo '<div>';
                    echo '<p class="text-sm">' . $openingHour['Day'] . '</p>';
                    echo '<p class="pb-4 text-sm">' . $openingHour['Time'] . '</p>';
                echo '</div>';
            }
        ?>
    </div>
</section>

<!-- company address -->
<section>
<?php
// get view with company address info
$queryCompanyAddressView = $dbCon->prepare("SELECT *
                                            FROM CompanyAddressView");

$queryCompanyAddressView->execute();
$getCompanyAddressView = $queryCompanyAddressView->fetchAll();
?>

<!-- display company address info -->
<div class="ten-percent pb-24">
    
    <?php    
    foreach ($getCompanyAddressView as $companyAddress) {
        echo "<h5>Find ". $companyAddress['NameOfCompany']." address:</h5>";
        echo "<div>";
            echo "<p>". $companyAddress['StreetName']."</p>";
            echo "<p>". $companyAddress['StreetNumber']."</p>";
        echo "</div>";

        echo "<div>";
            echo "<p>". $companyAddress['Country']."</p>";
            echo "<p>". $companyAddress['PostalCode']."</p>";
            echo "<p>". $companyAddress['City']."</p>";
        echo "</div>";
    }
    ?>
</div>
</section>
</body>
</html>