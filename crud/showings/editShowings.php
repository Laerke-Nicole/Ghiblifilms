<?php 
require_once ("includes/dbcon.php");
require_once ("includes/csrfProtection.php");
confirm_logged_in();

if (isset($_GET['ID'])) {

// get the showing to edit
$showingsID = htmlspecialchars(trim($_GET['ID']));

$query = $dbCon->prepare("SELECT * FROM Showings WHERE ShowingsID = :showingsID");
$query->bindParam(':showingsID', $showingsID);

$query->execute();

$getShowings = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit showing</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/dropdown.js" defer></script>
</head>

<body>

    <div class="container">
        <h3>Editing showings for "<?php echo htmlspecialchars(trim($getShowings[0]['ShowingsID'])); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="controllers/update.php">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            
            <!-- hidden input to connect to controller and oop -->
            <input type="hidden" name="table" value="Showings">
            <input type="hidden" name="original_ShowingsID" value="<?php echo htmlspecialchars(trim($showingsID)); ?>">

            <div class="row">
                <div class="input-field col s12">
                    <input id="MovieID" name="MovieID" type="number" value="<?php echo htmlspecialchars(trim($getShowings[0]['MovieID'])); ?>" class="validate" required="" aria-required="true">
                    <label for="MovieID">MovieID</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <p>Auditorium</p>
                    <select name="AuditoriumID" id="AuditoriumID" class="validate" required aria-required="true">
                        <?php
                        include ("controllers/movieController.php");
                        while ($auditorium = $auditoriumQuery->fetch()) {
                            $selected = $auditorium['AuditoriumID'] == $getShowings[0]['AuditoriumID'];
                            echo "<option value='{$auditorium['AuditoriumID']}' $selected>{$auditorium['AuditoriumNumber']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-field col s6">
                    <p>Screen format</p>
                    <select name="ScreenFormatID" id="ScreenFormatID" class="validate" required aria-required="true">
                        <?php
                        $screenFormatQuery = $dbCon->query("SELECT ScreenFormatID, ScreenFormat FROM ScreenFormat");
                        while ($screenFormat = $screenFormatQuery->fetch()) {
                            $selected = $screenFormat['ScreenFormatID'] == $getShowings[0]['ScreenFormatID']    ;
                            echo "<option value='{$screenFormat['ScreenFormatID']}' $selected>{$screenFormat['ScreenFormat']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="ShowingDate" name="ShowingDate" type="date" value="<?php echo htmlspecialchars(trim($getShowings[0]['ShowingDate'])); ?>" class="validate" required="" aria-required="true">
                    <label for="ShowingDate">ShowingDate</label>
                </div>

                <div class="input-field col s6">
                    <input id="ShowingTime" name="ShowingTime" type="time" value="<?php echo htmlspecialchars(trim($getShowings[0]['ShowingTime'])); ?>" class="validate" required="" aria-required="true">
                    <label for="ShowingTime">ShowingTime</label>
                </div>
            </div>

            <input type="hidden" name="ShowingsID" value="<?php echo htmlspecialchars(trim($showingsID)); ?>">

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