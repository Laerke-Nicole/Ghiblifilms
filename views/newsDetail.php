<?php
require_once("includes/dbcon.php"); 

if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $newsID = $_GET['ID'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("SELECT * FROM News WHERE NewsID = :newsID");
    $query->bindParam(':newsID', $newsID);
    $query->execute();
    $newsItem = $query->fetch();


    // if statement to show details on news
    if ($newsItem) {
        // display the details of the news
        echo '<section class="pt-24 pb-24 ten-percent">';
            echo '<div>';
                echo '<img src="upload/' . htmlspecialchars(trim($newsItem['NewsImg'])) . '" alt="Image of news" class="pb-4">';
                echo '<h2 class="pb-4">' . htmlspecialchars(trim($newsItem['Headline'])) . '</h2>';
                echo '<h5 class="pb-2">' . htmlspecialchars(trim($newsItem['SubHeadline'])) . '</h5>';
                echo '<p>' . htmlspecialchars(trim($newsItem['TextOfNews'])) . '</p>';
            echo '</div>';
        echo '</section>';
    } else {
        echo '<p>News item not found.</p>';
    }
}