<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars
    $genreName = htmlspecialchars(trim($_POST['GenreName']));

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("INSERT INTO Genre (GenreName) VALUES (:genreName)");

    // Prepare statements
    $query->bindParam(':genreName', $genreName);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>