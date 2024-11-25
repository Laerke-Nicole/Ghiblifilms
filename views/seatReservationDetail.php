<head>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/library.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<?php
require_once("includes/dbcon.php");
require_once("includes/session.php"); 
require_once("includes/functions.php");
include("modules/seatreservation/form.php"); 

confirm_logged_in();

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

// display reserved seats in a line
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
            <div class="flex pb-4">
                <p>Taken seats:</p>
                <p><?php echo $reservedSeatList; ?></p>
            </div>

            <div>
                <p>Price per seat: 12 euros</p>
            </div>

            <!-- seat selection form -->
            <form method="POST">
                <div class="pb-4">
                    <label for="Seats">Select seats, up to 5:</label>
                    <select name="Seats[]" id="Seats" multiple size="5">
                        <?php
                        foreach ($availableSeats as $seat) {
                            echo '<option value="' . $seat['SeatID'] . '">' . $seat['SeatNumber'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <input type="hidden" name="ShowingsID" value="<?php echo htmlspecialchars(trim($showingsID)); ?>">
                <button type="submit" class="btn">Choose seats</button>
            </form>
        </div>

        <div>
            <img src="img/seats.png" alt="Seating chart">
        </div>
    </div>
</div>