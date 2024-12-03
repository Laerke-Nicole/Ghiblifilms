<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['ShowingsID']) && isset($_POST['submit'])) {
    $showingsID = htmlspecialchars(trim($_POST['ShowingsID']));
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $auditoriumID = $_POST['AuditoriumID'];
    $screenFormatID = $_POST['ScreenFormatID'];
    $showingDate = htmlspecialchars(trim($_POST['ShowingDate']));
    $showingTime = htmlspecialchars(trim($_POST['ShowingTime']));

    $query = $dbCon->prepare("UPDATE Showings SET MovieID = :movieID, AuditoriumID = :auditoriumID, ScreenFormatID = :screenFormatID, ShowingDate = :showingDate, ShowingTime = :showingTime WHERE ShowingsID = :showingsID");
    
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':auditoriumID', $auditoriumID);
    $query->bindParam(':screenFormatID', $screenFormatID);
    $query->bindParam(':showingDate', $showingDate);
    $query->bindParam(':showingTime', $showingTime);
    $query->bindParam(':showingsID', $showingsID);
    
    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&ID=$showingsID");
    
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>