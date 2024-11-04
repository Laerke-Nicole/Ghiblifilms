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
                echo '<h2 class="text-center pb-4">' . htmlspecialchars($newsItem['Headline']) . '</h2>';
                echo '<img src="upload/' . htmlspecialchars($newsItem['NewsImg']) . '" alt="Image of news" class="pb-4">';
                echo '<h3 class="text-center pb-2">' . htmlspecialchars($newsItem['SubHeadline']) . '</h3>';
                echo '<p class="text-lg">' . nl2br(htmlspecialchars($newsItem['TextOfNews'])) . '</p>';
            echo '</div>';
        echo '</section>';
    } else {
        // If no news item found, display an error message
        echo '<p>News item not found.</p>';
    }
} 
