<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars
    $firstName = htmlspecialchars(trim($_POST['FirstName']));
    $lastName = htmlspecialchars(trim($_POST['LastName']));
    $roleInProductionID = htmlspecialchars(trim($_POST['RoleInProductionID']));

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("INSERT INTO Production (FirstName, LastName, RoleInProductionID) VALUES (:firstName, :lastName, :roleInProductionID)");

    // Prepare statements
    $query->bindParam(':firstName', $firstName);
    $query->bindParam(':lastName', $lastName);
    $query->bindParam(':roleInProductionID', $roleInProductionID);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>