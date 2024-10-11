<?php
require_once "dbcon.php";

if (isset($_POST['EntryID']) && isset($_POST['submit'])) {
    $userName = $_POST['Username'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['PhoneNumber'];
    $address = $_POST['Address'];
    $postalCode = $_POST['PostalCode'];
    $entryID = $_POST['EntryID'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("UPDATE User SET `Username`='$userName', `FirstName`='$firstName', `LastName`='$lastName', `Email`='$email', `PhoneNumber`='$phoneNumber', `Address`='$address', `PostalCode`='$postalCode' WHERE UserID=$entryID");
    $query->execute();
    header("Location: admin.php?status=updated&ID=$entryID");

} else {
    header("Location: admin.php?status=0");
}
?>
