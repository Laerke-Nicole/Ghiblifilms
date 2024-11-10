<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // trim and htmlspecialchars
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $premiereDate = htmlspecialchars(trim($_POST['PremiereDate']));

    // connect to db
    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("INSERT INTO Premiere (MovieID, PremiereDate) VALUES (:movieID, :premiereDate)");

    // bind parameters
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':premiereDate', $premiereDate);
    
    $query->execute();
    
    header("Location: ../../index.php?page=admin&status=added");
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>