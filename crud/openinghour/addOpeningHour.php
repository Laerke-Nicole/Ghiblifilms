<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars
    $day = htmlspecialchars(trim($_POST['Day']));
    $time = htmlspecialchars(trim($_POST['Time']));

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("INSERT INTO OpeningHour (`Day`, `Time`) VALUES (:day, :time)");

    // Prepare statements
    $query->bindParam(':day', $day);
    $query->bindParam(':time', $time);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>