<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // trim and htmlspecialchars
    $name = htmlspecialchars(trim($_POST['Name']), ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars(trim($_POST['Description']), ENT_QUOTES, 'UTF-8');
    $releaseYear = htmlspecialchars(trim($_POST['ReleaseYear']), ENT_QUOTES, 'UTF-8');
    $duration = htmlspecialchars(trim($_POST['Duration']), ENT_QUOTES, 'UTF-8');
    $movieImg = htmlspecialchars(trim($_POST['MovieImg']), ENT_QUOTES, 'UTF-8');
    $screenFormatID = htmlspecialchars(trim($_POST['ScreenFormatID']), ENT_QUOTES, 'UTF-8');

    $dbCon = dbCon($user, $pass);

    // prepare statements
    $query = $dbCon->prepare("INSERT INTO Movie (`Name`, `Description`, `ReleaseYear`, `Duration`, `MovieImg`, `ScreenFormatID`) VALUES (:name, :description, :releaseYear, :duration, :movieImg, :screenFormatID)");

    $query->bindParam(':name', $name);
    $query->bindParam(':description', $description);
    $query->bindParam(':releaseYear', $releaseYear);
    $query->bindParam(':duration', $duration);
    $query->bindParam(':movieImg', $movieImg);
    $query->bindParam(':screenFormatID', $screenFormatID);

    if ($query->execute()) {
        header("Location: ../index.php?page=admin&status=added");
    } else {
        header("Location: ../index.php?page=admin&status=error");
    }

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>