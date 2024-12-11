<?php
// get user reservations
$queryUserReservations = $dbCon->prepare("SELECT * FROM UserReservationView ORDER BY FirstName, LastName, ShowingDate, ShowingTime");
$queryUserReservations->execute();
$getUserReservations = $queryUserReservations->fetchAll();  