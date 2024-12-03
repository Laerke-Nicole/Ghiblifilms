<?php
require_once "includes/dbcon.php";

if (isset($_GET['ReservationID']) && isset($_GET['UserID'])) {
    $reservationID = htmlspecialchars(trim($_GET['ReservationID']));
    $userID = htmlspecialchars(trim($_GET['UserID']));

    try {
        // Start a transaction
        $dbCon->beginTransaction();

        // Get the amount from Payment
        $queryAmount = $dbCon->prepare("SELECT Amount FROM Payment WHERE ReservationID = :reservationID");
        $queryAmount->bindParam(':reservationID', $reservationID);
        $queryAmount->execute();
        $amount = $queryAmount->fetchColumn();

        // Update the BankAccount balance if Amount is not null
        if ($amount !== false) {
            $updateBalance = $dbCon->prepare("UPDATE BankAccount SET Balance = Balance - :amount WHERE AccountID = 1");
            $updateBalance->bindParam(':amount', $amount);
            $updateBalance->execute();
        }

        // Delete the reservation
        $deleteReservation = $dbCon->prepare("DELETE FROM Reservation WHERE ReservationID = :reservationID");
        $deleteReservation->bindParam(':reservationID', $reservationID);
        $deleteReservation->execute();

        // Commit the transaction
        $dbCon->commit();

        header("Location: index.php?page=userprofile&status=deleted&UserID=$userID");
    } catch (PDOException $e) {
        $dbCon->rollBack();
        header("Location: index.php?page=userprofile&status=error&UserID=$userID");
    }
}
?>