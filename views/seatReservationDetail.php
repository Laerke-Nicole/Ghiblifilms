<head>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/library.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<?php
require_once("includes/dbcon.php");
require_once("includes/session.php"); 

// ShowingsID in URL 
if (!isset($_GET['ShowingsID'])) {
    die("ShowingsID not specified.");
}

$showingsID = $_GET['ShowingsID']; 

$dbCon = dbCon($user, $pass);

// fetch already reserved seats for the showing
$queryReservedSeats = $dbCon->prepare("
    SELECT s.SeatNumber
    FROM Seat s
    JOIN SeatReservation sr ON s.SeatID = sr.SeatID
    WHERE sr.ShowingsID = :showingsID
");
$queryReservedSeats->bindParam(':showingsID', $showingsID);
$queryReservedSeats->execute();
$reservedSeats = $queryReservedSeats->fetchAll();

// display reserved seats
$reservedSeatList = implode(", ", array_column($reservedSeats, 'SeatNumber'));

// fetch available seats for the showing
$querySeats = $dbCon->prepare("
    SELECT s.SeatID, s.SeatNumber
    FROM Seat s
    LEFT JOIN SeatReservation sr ON s.SeatID = sr.SeatID AND sr.ShowingsID = :showingsID
    WHERE sr.SeatID IS NULL
    ORDER BY s.SeatNumber
");
$querySeats->bindParam(':showingsID', $showingsID);
$querySeats->execute();
$availableSeats = $querySeats->fetchAll();

?>

<div class="ten-percent">
    <div class="grid-cols-2">
        <div>
            <h1>Choose seats</h1>
            
            <!-- display reserved seats -->
            <div class="flex pb-2">
                <p>Taken seats:</p>
                <p><?php echo $reservedSeatList; ?></p>
            </div>

            <!-- seat selection form -->
            <form method="POST">
                <div class="pb-4">
                    <label for="seats">Select Seats (Up to 5):</label>
                    <select name="seats[]" id="seats" multiple size="5">
                        <?php
                        foreach ($availableSeats as $seat) {
                            echo '<option value="' . $seat['SeatID'] . '">' . $seat['SeatNumber'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn">Choose seats</button>
            </form>
        </div>

        <div>
            <img src="img/seats.png" alt="Seating chart">
        </div>
    </div>
</div>

<?php
// Process the reservation when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['seats'])) {
    $selectedSeats = $_POST['seats'];

    // Validate that no more than 5 seats are selected
    if (count($selectedSeats) > 5) {
        echo "<p style='color: red;'>You can only select up to 5 seats.</p>";
    } else {
        // Save the selected seats in the session
        $_SESSION['selected_seats'] = $selectedSeats;

        // Check if the user is logged in
        if (!isset($_SESSION['userID'])) {
            echo "<p style='color: red;'>Please log in to reserve seats.</p>";
        } else {
            // Insert reservation records for each selected seat
            foreach ($selectedSeats as $seatID) {
                $queryReserveSeat = $dbCon->prepare("
                    INSERT INTO SeatReservation (ShowingsID, SeatID, UserID, ReservationStatus)
                    VALUES (:showingsID, :seatID, :userID, 'Reserved')
                ");
                $queryReserveSeat->bindParam(':showingsID', $showingsID);
                $queryReserveSeat->bindParam(':seatID', $seatID);
                $queryReserveSeat->bindParam(':userID', $_SESSION['userID']);
                $queryReserveSeat->execute();
            }

            // Redirect to a confirmation or payment page
            header('Location: confirmation.php');
            exit();
        }
    }
}
?>