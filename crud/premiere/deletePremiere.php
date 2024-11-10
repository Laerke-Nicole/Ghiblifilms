<?php
require_once "includes/dbcon.php";

if (isset($_GET['PremiereID'])) {
    $premiereID = $_GET['PremiereID'];

    $dbCon = dbCon($user, $pass);

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM Premiere WHERE PremiereID = :premiereID");
    
    // Bind the parameter
    $query->bindParam(':premiereID', $premiereID);
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&PremiereID=$premiereID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>