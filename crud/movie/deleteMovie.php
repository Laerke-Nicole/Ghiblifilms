<?php
require_once "../../includes/dbcon.php";

if (isset($_GET['MovieID'])) {
    $movieID = htmlspecialchars(trim($_GET['MovieID']));

    $dbCon = dbCon($user, $pass);

    // Prepare the delete statement
    $query = $dbCon->prepare("DELETE FROM Movie WHERE MovieID = :movieID");

    // Bind the MovieID
    $query->bindParam(':movieID', $movieID, PDO::PARAM_INT);

    $query->execute();

    header("Location: ../index.php?page=admin&status=deleted&ID=$newsID");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>