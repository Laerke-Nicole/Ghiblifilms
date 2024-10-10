<?php
require_once "dbcon.php";
if (isset($_GET['UserID'])) {
    $entryID = $_GET['UserID'];
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("DELETE FROM User WHERE UserID=$entryID");
    $query->execute();

    header("Location: admin.php?status=deleted&ID=$entryID");
} else {
    header("Location: admin.php?status=0");
}
?>
