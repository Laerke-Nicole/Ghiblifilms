<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    // $auditoriumID = htmlspecialchars(trim($_POST['AuditoriumID']));
    $auditoriumID = $_POST['AuditoriumID'];
    $screenFormatID = $_POST['ScreenFormatID'];
    $ShowingDate = htmlspecialchars(trim($_POST['ShowingDate']));
    $ShowingTime = htmlspecialchars(trim($_POST['ShowingTime']));

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("INSERT INTO Showings (MovieID, AuditoriumID, ScreenFormatID, ShowingDate, ShowingTime) VALUES (:movieID, :auditoriumID, :screenFormatID, :showingDate, :showingTime)");

    // Prepare statements
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':auditoriumID', $auditoriumID);
    $query->bindParam(':screenFormatID', $screenFormatID);
    $query->bindParam(':showingDate', $ShowingDate);
    $query->bindParam(':showingTime', $ShowingTime);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>