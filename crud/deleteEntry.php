<?php
require_once "dbcon.php";
if (isset($_GET['ID'])) {
    $entryID = $_GET['ID'];
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("DELETE FROM customers WHERE id=$entryID");
    $query->execute();

    header("Location: admin?status=deleted&ID=$entryID");
}else{
    header("Location: admin?status=0");
}