<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['MovieID']) && isset($_POST['submit'])) {
    $name = htmlspecialchars(trim($_POST['Name']), ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars(trim($_POST['Description']), ENT_QUOTES, 'UTF-8');
    $releaseYear = htmlspecialchars(trim($_POST['ReleaseYear']), ENT_QUOTES, 'UTF-8');
    $duration = htmlspecialchars(trim($_POST['Duration']), ENT_QUOTES, 'UTF-8');
    $movieImg = htmlspecialchars(trim($_POST['MovieImg']), ENT_QUOTES, 'UTF-8');
    $screenFormatID = htmlspecialchars(trim($_POST['ScreenFormatID']), ENT_QUOTES, 'UTF-8');
    $movieID = htmlspecialchars(trim($_POST['MovieID']), ENT_QUOTES, 'UTF-8');

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("UPDATE Movie SET `Name` = :name, `Description` = :description, `ReleaseYear` = :releaseYear, `Duration` = :duration, `MovieImg` = :movieImg, `ScreenFormatID` = :screenFormatID WHERE MovieID = :movieID");

    $query->bindParam(':name', $name);
    $query->bindParam(':description', $description);
    $query->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
    $query->bindParam(':duration', $duration);
    $query->bindParam(':movieImg', $movieImg);
    $query->bindParam(':screenFormatID', $screenFormatID, PDO::PARAM_INT);
    $query->bindParam(':movieID', $movieID, PDO::PARAM_INT);
    
    $query->execute();

    header("Location: ../index.php?page=admin&status=updated&ID=$movieID");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>
