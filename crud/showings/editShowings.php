<?php 
require_once "includes/dbcon.php";

if (isset($_GET['ID'])) {
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
</head>

<?php
$showingsID = htmlspecialchars($_GET['ID']);

$query = $dbCon->prepare("SELECT * FROM Showings WHERE ShowingsID = :showingsID");
$query->bindParam(':showingsID', $showingsID);

$query->execute();

$getShowings = $query->fetchAll();
?>

<body>

    <div class="container">
        <h3>Editing showings for "<?php echo htmlspecialchars($getShowings[0]['ShowingsID']) ?>"</h3>
        <form class="col s12" name="contact" method="post" action="crud/showings/updateShowings.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="MovieID" name="MovieID" type="number" value="<?php echo htmlspecialchars($getShowings[0]['MovieID']); ?>" class="validate" required="" aria-required="true">
                    <label for="MovieID">MovieID</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <p>Auditorium</p>
                    <select name="AuditoriumID" id="AuditoriumID" class="validate" required aria-required="true">
                        <?php
                        $auditoriumQuery = $dbCon->query("SELECT AuditoriumID, AuditoriumNumber FROM Auditorium");
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
                    <input id="ShowingDate" name="ShowingDate" type="date" value="<?php echo htmlspecialchars($getShowings[0]['ShowingDate']); ?>" class="validate" required="" aria-required="true">
                    <label for="ShowingDate">ShowingDate</label>
                </div>

                <div class="input-field col s6">
                    <input id="ShowingTime" name="ShowingTime" type="time" value="<?php echo htmlspecialchars($getShowings[0]['ShowingTime']); ?>" class="validate" required="" aria-required="true">
                    <label for="ShowingTime">ShowingTime</label>
                </div>
            </div>

            <input type="hidden" name="ShowingsID" value="<?php echo htmlspecialchars($showingsID); ?>">

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