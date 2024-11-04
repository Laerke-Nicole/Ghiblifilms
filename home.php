<?php require_once ("includes/dbcon.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php //confirm_logged_in(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghiblifilms</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/library.css">
    <link rel="stylesheet" href="style/responsive.css">
    <link rel="stylesheet" href="https://use.typekit.net/arj0iay.css">
</head>
<body>
    
<!-- news -->
<section class="pt-24 pb-24 ten-percent">
    <div>
        <h2 class="text-center pb-4">NEWS</h2>
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
        <h2 class="text-center pb-4">Upcoming movies</h2>
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
            echo '<button class="btn" onclick="window.location.href=\'moviedetail.php?ID=' . $getMovie['MovieID'] . '\'">Get tickets</button>'; 
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
    <h1 class="text-3xl weight-400 pb-12">Contact us with any questions</h1>

    <!-- contact form -->
    <div class="flex gap-4">
        <div class="w-half">
            <div>
                <h2 class="text-xl pb-4">Fill out the form below and we will get back to you as soon as possible.</h2>
            </div>

            <!-- input fields -->
            <div class="w-half">
                <form class="contact-form">
                    <div>
                        <input type="text" id="name" name="name" placeholder="First name">
                    </div>

                    <div>
                        <input type="text" id="name" name="name" placeholder="Last name">
                    </div>

                    <div>
                        <input type="email" id="email" name="email" placeholder="Email">
                    </div>

                    <div>
                        <input type="tel" id="tel" name="tel" placeholder="Phone number">
                    </div>

                    <div>
                        <textarea id="message" name="message" placeholder="Message"></textarea>
                    </div>

                    <button class="btn">Send mail</button>
                </form>
            </div>
        </div>
        
        <!-- contact info -->
        <div class="w-half">
            <div class="box">
                <h3 class="text-xl pb-4">Prefer a direct contact? You can reach us via email or phone:</h3>

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
</body>
</html>