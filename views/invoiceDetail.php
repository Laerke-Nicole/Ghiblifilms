<?php
require_once("includes/dbcon.php");
require_once("includes/connection.php");
require_once("includes/functions.php");
require_once("includes/session.php");
confirm_logged_in();

require_once __DIR__ . '/../vendor/autoload.php';
include("modules/payment/secretAPI.php");

if (!isset($_GET['payment_intent'])) {
    die('PaymentIntent ID is missing');
}

$paymentIntentId = $_GET['payment_intent'];

try {
    $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

    
    if ($paymentIntent->status === 'succeeded') {
        // if the payment is successful display the invoice.php
        include("modules/invoice/invoice.php");
        
    } elseif ($paymentIntent->status === 'requires_payment_method') {
        echo 'Payment failed. Please try again.';
        echo '<a href="index.php?page=showingdetail&showingid=' . $_SESSION['ShowingsID'] . '" class="btn btn-primary">Go back</a>';
    } else {
        echo 'Payment status: ' . $paymentIntent->status;
        echo '<a href="index.php?page=showingdetail&showingid=' . $_SESSION['ShowingsID'] . '" class="btn btn-primary">Go back</a>';
    }
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo 'Error fetching payment status: ' . $e->getMessage();
}


// update payment status to 'paid' in the database
if ($paymentIntent->status === 'succeeded') {    
    $reservationID = $_SESSION['ReservationID']; 
    
    $queryUpdatePayment = $dbCon->prepare("
        UPDATE Reservation
        SET PaymentStatus = 'Paid'
        WHERE ReservationID = :reservationID
    ");
    $queryUpdatePayment->bindParam(':reservationID', $reservationID);
    $queryUpdatePayment->execute();
}

$_SESSION['ReservationID'] = $reservationID;
?>