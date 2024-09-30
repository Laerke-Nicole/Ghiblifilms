<?php
require_once "dbcon.php";
if (isset($_GET['ID'])) {
    $entryID = $_GET['ID'];
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("DELETE FROM customers WHERE id=$entryID");
    $query->execute();

    header("Location: crud.php?status=deleted&ID=$entryID");
}else{
    header("Location: crud.php?status=0");
}