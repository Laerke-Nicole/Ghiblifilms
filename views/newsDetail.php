<?php
require_once("includes/dbcon.php"); 

if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $newsID = $_GET['ID'];

    include("controllers/companyController.php");

    // if no news exists with the given ID, display an error message
    if (!$getNewsItem) {
        die("News item not found.");
    }

    // if statement to show details on news
    if ($getNewsItem) {
        // display the details of the news
        echo '<section class="pt-24 pb-24 ten-percent">';
            echo '<div>';
                echo '<img src="upload/' . htmlspecialchars(trim($getNewsItem['NewsImg'])) . '" alt="Image of news" class="pb-4">';
                echo '<h2 class="pb-4">' . htmlspecialchars(trim($getNewsItem['Headline'])) . '</h2>';
                echo '<h5 class="pb-2">' . htmlspecialchars(trim($getNewsItem['SubHeadline'])) . '</h5>';
                echo '<p>' . htmlspecialchars(trim($getNewsItem['TextOfNews'])) . '</p>';
            echo '</div>';
        echo '</section>';
    } else {
        echo '<p>News item not found.</p>';
    }
}