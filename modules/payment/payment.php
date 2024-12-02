<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../includes/dbcon.php';
require_once __DIR__ . '/../../includes/session.php';

header('Content-Type: application/json');

// Retrieve the JSON input from the client  
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['paymentMethodId'])) {
    echo json_encode(['error' => 'Payment method not provided.']);
    exit;
}

try {
    // API Key
    \Stripe\Stripe::setApiKey('sk_test_51QPRkfJdwUEjEc4U9XNhhHmwGq2j6TsckXUKqjCmzKzXy0QOucvUHze5JfZ4lNT5t34vq9RItphIqu418cTCCtYG00i8gkOzZC');

    // Fetch session data
    $dbCon = dbCon($user, $pass);
    $userID = $_SESSION['UserID'];
    $showingsID = $_SESSION['ShowingsID'];
    $selectedSeats = $_SESSION['SelectedSeats']; // Fetch the seat IDs

    // Calculate the total price
    $pricePerSeat = 1200;
    $totalPrice = count($selectedSeats) * $pricePerSeat;

    // Insert reservation into the database
    $queryCreateReservation = $dbCon->prepare("
        INSERT INTO Reservation (UserID, ShowingsID, ReservationDate) 
        VALUES (:userID, :showingsID, NOW())
    ");
    $queryCreateReservation->bindParam(':userID', $userID);
    $queryCreateReservation->bindParam(':showingsID', $showingsID);
    $queryCreateReservation->execute();

    // Get the newly created ReservationID
    $reservationID = $dbCon->lastInsertId();
    $_SESSION['ReservationID'] = $reservationID;

    // Insert seats into SeatReservation table
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

    // Insert payment record into Payment table
    $queryPayment = $dbCon->prepare("
        INSERT INTO Payment (ReservationID, PaymentType, Amount) 
        VALUES (:reservationID, 'CreditCard', :amount)
    ");
    $queryPayment->bindParam(':reservationID', $reservationID);
    $queryPayment->bindParam(':amount', $totalPrice);
    $queryPayment->execute();

    // Update Reservation table PaymentStatus to Paid
    $queryUpdateReservation = $dbCon->prepare("
        UPDATE Reservation
        SET PaymentStatus = 'Paid'
        WHERE ReservationID = :reservationID
    ");
    $queryUpdateReservation->bindParam(':reservationID', $reservationID);
    $queryUpdateReservation->execute();

    // the return URL to go to invoice page
    $returnUrl = 'http://localhost/ghiblifilms/index.php?page=invoicedetail';
    
    // Create a PaymentIntent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $totalPrice, // Total amount in cents
        'currency' => 'eur',
        'payment_method' => $data['paymentMethodId'],
        'confirmation_method' => 'manual',
        'confirm' => true,
        'return_url' => $returnUrl,
    ]);

    // Clear session
    unset($_SESSION['ShowingsID'], $_SESSION['SelectedSeats']);

    // Respond with the PaymentIntent and its ID
    echo json_encode(['success' => true, 'payment_intent' => $paymentIntent->id]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}