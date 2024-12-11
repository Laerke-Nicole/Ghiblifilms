<?php
require_once("includes/dbcon.php");

if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $movieID = $_GET['ID'];

    // get everything from the movie table
    include ("controllers/movieController.php");  
    
    // if they dont exist, display an error message
    if (!$movieItem || !$genres || !$voiceActor || !$production) {
        die("Not all items found.");
    } else {
        // display the details of the movie
        // movie overall info 
        echo include ("modules/movie/moviedetails.php");
        
        // display the team of the movie
        echo include ("modules/movie/team.php");

        // display showings
        echo include ("modules/movie/showings.php");
    }
}
?>