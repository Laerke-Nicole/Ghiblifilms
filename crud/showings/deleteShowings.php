<?php
require_once "includes/dbcon.php";

if (isset($_GET['ShowingsID'])) {
    $showingsID = $_GET['ShowingsID'];

    $dbCon = dbCon($user, $pass);

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM Showings WHERE ShowingsID = :showingsID");
    
    // Bind the parameter
    $query->bindParam(':showingsID', $showingsID);
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&ShowingsID=$showingsID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>