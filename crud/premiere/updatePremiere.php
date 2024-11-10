<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['PremiereID']) && isset($_POST['submit'])) {
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $premiereDate = htmlspecialchars(trim($_POST['PremiereDate']));
    $premiereID = htmlspecialchars(trim($_POST['PremiereID']));

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("UPDATE Premiere SET MovieID = :movieID, PremiereDate = :premiereDate WHERE PremiereID = :premiereID");
    
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':premiereDate', $premiereDate);
    $query->bindParam(':premiereID', $premiereID);
    
    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&ID=$premiereID");
    
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>