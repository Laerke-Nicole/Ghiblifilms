<?php
require_once ("includes/csrfProtection.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <script src="modules/payment/stripe.js" defer></script>
    
</head>
<body>
<div class="ten-percent grid-cols-2 pt-6 pb-20">
    <!-- booking overview -->
    <div>
        <h2 class="pb-4">Order Overview</h2>

        <p><strong>Movie:</strong> <?php echo $getShowingsInfo['MovieName']; ?></p>
        <p><strong>Showing Date:</strong> <?php echo $getShowingsInfo['ShowingDate']; ?></p>
        <p><strong>Showing Time:</strong> <?php echo $getShowingsInfo['ShowingTime']; ?></p>
        
        <br />
        
        <!-- icon of a pencil -->
        <a href="index.php?page=edituserinfo&UserID=<?php echo htmlspecialchars($userID); ?>"><i class="material-icons pencil secondary-color">edit</i></a>
        <p><strong>Name:</strong> <?php echo $getUserInfo['FirstName'] . ' ' . $getUserInfo['LastName']; ?></p>
        <p><strong>Email:</strong> <?php echo $getUserInfo['Email']; ?></p>
        <p><strong>Phone Number:</strong> <?php echo $getUserInfo['PhoneNumber']; ?></p>
        
        <br />

        <p><strong>Selected Seats:</strong> <?php echo implode(", ", $seatNumbers); ?></p>
        <p class="pb-4"><strong>Total Price:</strong> €<?php echo number_format($totalPrice, 2); ?></p>
        <img src="img/seats.png" alt="Seating chart" height="200">
    </div>

    <!-- payment -->
    <div>
        <h3 class="pb-4">Payment</h3>
        <form id="payment-form">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            
            <div id="card-element" class="pb-4">
                <!-- stripe.js adds fields here -->
            </div>

            <button id="submit" class="btn-two">Pay</button>

            <!-- stripes error -->
            <div id="error-message"></div>
        </form>
    </div>
</div>
</body>
</html>