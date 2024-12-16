<?php
require_once("includes/dbcon.php"); 

// if the id is set get the news item
if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $newsID = $_GET['ID'];

    include("controllers/companyController.php");

    // if no news exists with the ID display an error message
    if (!$getNewsItem) {
        die("News item not found.");
    }

    include ("modules/news/news.php");
}