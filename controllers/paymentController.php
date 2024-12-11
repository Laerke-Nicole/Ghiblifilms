<?php

// get showings info
$queryShowingsInfo = $dbCon->prepare("
    SELECT s.ShowingDate, s.ShowingTime, m.Name AS MovieName
    FROM Showings s
    JOIN Movie m ON s.MovieID = m.MovieID
    WHERE s.ShowingsID = :showingsID
");
$queryShowingsInfo->bindParam(':showingsID', $showingsID);
$queryShowingsInfo->execute();
$getShowingsInfo = $queryShowingsInfo->fetch();

// get user info
$queryUserInfo = $dbCon->prepare("SELECT FirstName, LastName, Email, PhoneNumber FROM User WHERE UserID = :userID");
$queryUserInfo->bindParam(':userID', $userID);
$queryUserInfo->execute();
$getUserInfo = $queryUserInfo->fetch();


// Fetch seat numbers based on seat IDs
$seatPlaceholders = implode(", ", array_fill(0, count($selectedSeatIDs), "?"));
$querySeats = $dbCon->prepare("
    SELECT SeatNumber 
    FROM Seat 
    WHERE SeatID IN ($seatPlaceholders)
");
$querySeats->execute($selectedSeatIDs);
$seatNumbers = array_column($querySeats->fetchAll(), 'SeatNumber');