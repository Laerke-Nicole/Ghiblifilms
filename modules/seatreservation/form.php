<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Seats'])) {

    $selectedSeats = $_POST['Seats'];
    $showingsID = $_POST['ShowingsID'];

    if (!is_array($selectedSeats) || count($selectedSeats) > 5) {
        die("<p style='color: red;'>You can select up to 5 seats.</p>"
        // button to go back to the seat selection page
        . "<a href='index.php?page=seatreservationdetail&ShowingsID=$showingsID'>Go back</a>"
        );
    }

    $dbCon = dbCon($user, $pass);

    // insert showings and user info into reservation table
    $queryCreateReservation = $dbCon->prepare("
        INSERT INTO Reservation (UserID, ShowingsID, ReservationDate) 
        VALUES (:userID, :showingsID, NOW())
    ");
    $queryCreateReservation->bindParam(':userID', $_SESSION['UserID']);
    $queryCreateReservation->bindParam(':showingsID', $showingsID);
    $queryCreateReservation->execute();

    // get the ReservationID
    $reservationID = $dbCon->lastInsertId();

    // insert into SeatReservation table
    foreach ($selectedSeats as $seatID) {
        $queryReserveSeat = $dbCon->prepare("
            INSERT INTO SeatReservation (ShowingsID, SeatID, ReservationID)
            VALUES (:showingsID, :seatID, :reservationID)
        ");
        $queryReserveSeat->bindParam(':showingsID', $showingsID);
        $queryReserveSeat->bindParam(':seatID', $seatID);
        $queryReserveSeat->bindParam(':reservationID', $reservationID);
        $queryReserveSeat->execute();
    }

    // redirect to payment page
    header ("Location: index.php?page=paymentdetail&reservationID=" . $reservationID);
    exit ();
}
?>