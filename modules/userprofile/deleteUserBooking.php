<?php
require_once "includes/dbcon.php";

if (isset($_GET['ReservationID']) && isset($_GET['UserID'])) {
    $reservationID = htmlspecialchars(trim($_GET['ReservationID']));
    $userID = htmlspecialchars(trim($_GET['UserID']));

    try {
        // Start a transaction
        $dbCon->beginTransaction();

        // Delete the reservation (assuming cascading deletes take care of related rows)
        $deleteReservation = $dbCon->prepare("DELETE FROM Reservation WHERE ReservationID = :reservationID");
        $deleteReservation->bindParam(':reservationID', $reservationID);
        $deleteReservation->execute();

        // Commit the transaction
        $dbCon->commit();

        // Redirect after successful deletion
        header("Location: index.php?page=userprofile&status=deleted&UserID=$userID");

    } catch (PDOException $e) {
        // Rollback the transaction
        $dbCon->rollBack();

        // Redirect with error status
        header("Location: index.php?page=userprofile&status=error&UserID=$userID");

    }
} else {
    // Redirect with missing parameter status
    header("Location: index.php?page=userprofile&status=missing");
}
?>