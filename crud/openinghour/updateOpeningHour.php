<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['OpeningHourID']) && isset($_POST['submit'])) {
    $day = htmlspecialchars(trim($_POST['Day']), ENT_QUOTES, 'UTF-8');
    $time = htmlspecialchars(trim($_POST['Time']), ENT_QUOTES, 'UTF-8');
    $openingHourID = htmlspecialchars(trim($_POST['OpeningHourID']), ENT_QUOTES, 'UTF-8');

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("UPDATE OpeningHour SET `Day` = :day, `Time` = :time WHERE OpeningHourID = :openingHourID");
    
    $query->bindParam(':day', $day);
    $query->bindParam(':time', $time);
    $query->bindParam(':openingHourID', $openingHourID, PDO::PARAM_INT);
    
    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&ID=$openingHourID");
    
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>