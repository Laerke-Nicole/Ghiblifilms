<?php
require_once "dbcon.php";

if (isset($_GET['UserID'])) {
    $userID = $_GET['UserID'];

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("DELETE FROM User WHERE UserID=$userID");
    
    $query->execute();

    header("Location: ../index.php?page=admin&status=deleted&ID=$userID");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>  