<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['PostalCode']) && isset($_POST['submit'])) {
    $postalCode = htmlspecialchars(trim($_POST['PostalCode']));
    $city = htmlspecialchars(trim($_POST['City']));

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("UPDATE PostalCode SET PostalCode = :postalCode, City = :city WHERE PostalCode = :postalCode");
    
    $query->bindParam(':postalCode', $postalCode);
    $query->bindParam(':city', $city);
    
    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&ID=$postalCode");
    
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>