<?php
require_once "dbcon.php";

if (isset($_POST['UserID']) && isset($_POST['submit'])) {
    $userName = htmlspecialchars(trim($_POST['Username']), ENT_QUOTES, 'UTF-8');
    $firstName = htmlspecialchars(trim($_POST['FirstName']), ENT_QUOTES, 'UTF-8');
    $lastName = htmlspecialchars(trim($_POST['LastName']), ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars(trim($_POST['Email']), ENT_QUOTES, 'UTF-8');
    $phoneNumber = htmlspecialchars(trim($_POST['PhoneNumber']), ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars(trim($_POST['Address']), ENT_QUOTES, 'UTF-8');
    $postalCode = htmlspecialchars(trim($_POST['PostalCode']), ENT_QUOTES, 'UTF-8');
    $userID = htmlspecialchars(trim($_POST['UserID']), ENT_QUOTES, 'UTF-8');

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("UPDATE User SET `Username` = :username, `FirstName` = :firstName, `LastName` = :lastName, `Email` = :email, `PhoneNumber` = :phoneNumber, `Address` = :address, `PostalCode` = :postalCode WHERE UserID = :userID");
    
    $query->bindParam(':username', $userName);
    $query->bindParam(':firstName', $firstName);
    $query->bindParam(':lastName', $lastName);
    $query->bindParam(':email', $email);
    $query->bindParam(':phoneNumber', $phoneNumber);
    $query->bindParam(':address', $address);
    $query->bindParam(':postalCode', $postalCode);
    $query->bindParam(':userID', $userID, PDO::PARAM_INT);
    
    $query->execute();

    header("Location: ../index.php?page=admin&status=updated&ID=$userID");
    
} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>
