<?php
require_once("includes/dbcon.php"); // Ensure database connection

// Check if 'ID' is set in the URL and is a valid number
if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $newsID = $_GET['ID'];

    // Connect to the database and prepare the statement to fetch the news item
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("SELECT * FROM News WHERE NewsID = :newsID");
    $query->bindParam(':newsID', $newsID, PDO::PARAM_INT);
    $query->execute();
    $newsItem = $query->fetch();

    // Check if a news item was found
    if ($newsItem) {
        // Display the details of the news item
        echo '<section class="pt-24 pb-24 ten-percent">';
            echo '<div>';
                echo '<img src="upload/' . $newsItem['NewsImg'] . '" alt="Image of news" class="pb-4">';
                echo '<h2 class="pb-4">' . $newsItem['Headline'] . '</h2>';
                echo '<h5 class="pb-2">' . $newsItem['SubHeadline'] . '</h5>';
                echo '<p>' . $newsItem['TextOfNews'] . '</p>';
            echo '</div>';
        echo '</section>';
    } else {
        // If no news item found, display an error message
        echo '<p>News item not found.</p>';
    }
} 
