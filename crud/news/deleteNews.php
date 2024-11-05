<?php
require_once "includes/dbcon.php";

if (isset($_GET['NewsID'])) {
    $newsID = htmlspecialchars(trim($_GET['NewsID']));
    
    $dbCon = dbCon($user, $pass);
    
    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM News WHERE NewsID = :newsID");

    // bind
    $query->bindParam(':newsID', $newsID);

    $query->execute();

    header("Location: index.php?page=admin&status=deleted&ID=$newsID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>