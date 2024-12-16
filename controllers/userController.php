<?php
// get user info to edit
$query = $dbCon->prepare("SELECT U.*, A.StreetName, A.StreetNumber, A.PostalCode, A.Country 
                           FROM User U 
                           LEFT JOIN Address A ON U.AddressID = A.AddressID 
                           WHERE U.UserID = :userID");
$query->bindParam(':userID', $userID);
$query->execute();
$getUsers = $query->fetchAll(); 


// get users with address details
$queryUser = $dbCon->prepare("SELECT U.*, A.StreetName, A.StreetNumber, A.PostalCode, A.Country 
                                FROM User U 
                                LEFT JOIN Address A ON U.AddressID = A.AddressID");
$queryUser->execute();
$users = $queryUser->fetchAll();


// get user view
$queryUserProfileView = $dbCon->prepare("SELECT * FROM UserProfileView 
                                        WHERE UserID = :userID");
$queryUserProfileView->bindParam(':userID', $userID);
$queryUserProfileView->execute();
$getUserProfileView = $queryUserProfileView->fetchAll();


// get user reservations
$queryUserReservations = $dbCon->prepare("SELECT * FROM UserReservationView 
                                            WHERE UserID = :userID");
$queryUserReservations->bindParam(':userID', $userID);
$queryUserReservations->execute();
$getUserReservations = $queryUserReservations->fetchAll();


// check if user is admin
$query = "SELECT Role 
            FROM User 
            WHERE UserID = :userID 
            LIMIT 1";
$stmt = $dbCon->prepare($query);
$stmt->bindParam(':userID', $userID);
$stmt->execute();
$admin = $stmt->fetch();