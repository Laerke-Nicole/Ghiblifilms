<?php
require_once("includes/dbcon.php");

// if the id is set get the movie item
if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $movieID = $_GET['ID'];

    // get everything from the movie table
    include ("controllers/movieController.php");  
    
    // if movie cant be found, display an error message
    if (!$movieItem) {
        die("Section(s) is empty.");
    } else {
        // display the details of the movie
        // movie overall info 
        include ("modules/movie/moviedetails.php");

        // trailer
        include ("modules/movie/trailer.php");

        // display showings
        include ("modules/movie/showings.php");
    }
}
?>