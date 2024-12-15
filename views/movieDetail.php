<?php
require_once("includes/dbcon.php");

if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $movieID = $_GET['ID'];

    // get everything from the movie table
    include ("controllers/movieController.php");  
    
    // if they dont exist, display an error message
    if (!$movieItem) {
        die("Section(s) is empty.");
    } else {
        // display the details of the movie
        // movie overall info 
        include ("modules/movie/moviedetails.php");
        
        // display the team of the movie
        include ("modules/movie/team.php");

        // display showings
        include ("modules/movie/showings.php");
    }
}
?>