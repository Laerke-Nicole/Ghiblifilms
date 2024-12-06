<?php 
require_once "includes/dbcon.php";
confirm_logged_in();

if (isset($_GET['ID'])) {

// get the opening hour to edit
$openingHourID = htmlspecialchars($_GET['ID']);
$query = $dbCon->prepare("SELECT * FROM OpeningHour WHERE OpeningHourID = :openingHourID");
$query->bindParam(':openingHourID', $openingHourID);
$query->execute();
$getOpeningHours = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Opening Hour</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>

<div class="container">
        <h3>Editing Opening Hour for "<?php echo htmlspecialchars($getOpeningHours[0]['Day']); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="controllers/update.php">
            <!-- hidden input to connect to controller and oop -->
            <input type="hidden" name="table" value="OpeningHour">
            <input type="hidden" name="original_OpeningHourID" value="<?php echo htmlspecialchars($openingHourID); ?>">

            <div class="row">
                <div class="input-field col s6">
                    <input id="Day" name="Day" type="text" value="<?php echo htmlspecialchars($getOpeningHours[0]['Day']); ?>" class="validate" required="" aria-required="true">
                    <label for="Day">Day</label>
                </div>
                <div class="input-field col s6">
                    <input id="Time" name="Time" type="text" value="<?php echo htmlspecialchars($getOpeningHours[0]['Time']); ?>" class="validate" required="" aria-required="true">
                    <label for="Time">Time</label>
                </div>
            </div>

            <input type="hidden" name="OpeningHourID" value="<?php echo htmlspecialchars($openingHourID); ?>">

            <button class="btn waves-effect waves-light" type="submit" name="submit">Update
            </button>
        </form>
    </div>
</div>
</body>
</html>

<?php 
} else {    
    header("Location: ../index.php?page=admin&status=0");
}
?>