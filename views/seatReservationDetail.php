<?php
require_once("includes/dbcon.php");
require_once("includes/functions.php");
require_once("includes/session.php");

confirm_logged_in();

// ShowingsID in URL
if (!isset($_GET['ShowingsID'])) {
    die("ShowingsID not specified.");
}

$showingsID = $_GET['ShowingsID']; 
$_SESSION['ShowingsID'] = $showingsID; // Save ShowingsID in session

$dbCon = dbCon($user, $pass);

// Fetch already reserved seats for the showing
$queryReservedSeats = $dbCon->prepare("
    SELECT s.SeatNumber
    FROM Seat s
    JOIN SeatReservation sr ON s.SeatID = sr.SeatID
    WHERE sr.ShowingsID = :showingsID
");
$queryReservedSeats->bindParam(':showingsID', $showingsID);
$queryReservedSeats->execute();
$reservedSeats = $queryReservedSeats->fetchAll();

// Display reserved seats
$reservedSeatList = implode(", ", array_column($reservedSeats, 'SeatNumber'));

// Fetch available seats for the showing
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
            
            <!-- Display reserved seats -->
            <div class="flex pb-4 gap-4">
                <p><strong>Taken seats:</strong></p>
                <p><?php echo $reservedSeatList; ?></p>
            </div>

            <div>
                <p>Price per seat: 12 euros</p>
            </div>

            <br/>

            <!-- Seat selection form -->
            <form method="POST" action="index.php?page=seatreservationform">
                <div class="pb-4">
                    <label for="Seats">Select seats, up to 5:</label>
                    <div id="Seats">
                        <?php foreach ($availableSeats as $seat): ?>
                            <label>
                                <input type="checkbox" name="Seats[]" value="<?php echo $seat['SeatID']; ?>">
                                <?php echo htmlspecialchars($seat['SeatNumber']); ?>
                            </label><br>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button type="submit" class="btn">Choose seats</button>
            </form>
        </div>

        <div>
            <img src="img/seats.png" alt="Seating chart">
        </div>
    </div>
</div>