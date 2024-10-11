<?php
require_once "dbcon.php";

if (isset($_GET['NewsID'])) {
    $newsID = $_GET['NewsID'];
    $dbCon = dbCon($user, $pass);
    
    $query = $dbCon->prepare("DELETE FROM News WHERE NewsID = $newsID");
    $query->execute();

    header("Location: admin.php?status=deleted&ID=$newsID");
} else {
    header("Location: admin.php?status=0");
}
?>


