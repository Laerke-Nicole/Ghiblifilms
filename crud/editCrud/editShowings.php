<?php 
require_once ("includes/dbcon.php");
require_once ("includes/csrfProtection.php");
require_once ("oop/getIDOOP.php");
confirm_is_admin();

try {
    $params = GetID::getValues(['ID']);
    $showingsID = $params['ID'];
    
} catch (Exception $e) { 
    header("Location: ../index.php?page=admin&status=0");
    exit;
}

include ("controllers/adminController.php");
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
        <h3>Editing showing</h3>
        <form class="col s12" name="contact" method="post" action="controllers/update.php">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            
            <!-- hidden input to connect to controller and oop -->
            <input type="hidden" name="table" value="Showings">
            <input type="hidden" name="original_ShowingsID" value="<?php echo htmlspecialchars(trim($showingsID)); ?>">

            <div class="row">
                <div class="input-field col s12">
                    <p>Movie name</p>
                    <select name="MovieID" id="MovieID">
                        <?php
                        include ("controllers/adminController.php");
                        while ($movie = $movieQuery->fetch()) {
                            $selected = $movie['MovieID'] == $getShowings[0]['MovieID'] ? 'selected' : '';
                            echo "<option value='{$movie['MovieID']}' $selected>{$movie['Name']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <p>Auditorium</p>
                    <select name="AuditoriumID" id="AuditoriumID" class="validate" required aria-required="true">
                        <?php
                        include ("controllers/adminController.php");
                        while ($auditorium = $auditoriumQuery->fetch()) {
                            $selected = $auditorium['AuditoriumID'] == $getShowings[0]['AuditoriumID'] ? 'selected' : '';
                            echo "<option value='{$auditorium['AuditoriumID']}' $selected>{$auditorium['AuditoriumNumber']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-field col s6">
                    <p>Screen format</p>
                    <select name="ScreenFormatID" id="ScreenFormatID" class="validate" required aria-required="true">
                        <?php
                        include ("controllers/adminController.php");
                        while ($screenFormat = $screenFormatQuery->fetch()) {
                            $selected = $screenFormat['ScreenFormatID'] == $getShowings[0]['ScreenFormatID'] ? 'selected' : '';
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