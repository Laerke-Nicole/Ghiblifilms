<?php
require_once("includes/dbcon.php"); 

if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $newsID = $_GET['ID'];

    include("controllers/companyController.php");

    // if no news exists with the given ID, display an error message
    if (!$getNewsItem) {
        die("News item not found.");
    }

    include ("modules/news/news.php");
}