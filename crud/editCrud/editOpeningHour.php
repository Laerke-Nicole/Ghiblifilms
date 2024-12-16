<?php 
require_once ("includes/dbcon.php");
require_once ("includes/csrfProtection.php");
require_once ("oop/getIDOOP.php");
confirm_is_admin();

// get the opening hour id from the url
try {
    // retrieve the id from the url with GetID::getValues
    $params = GetID::getValues(['ID']);
    // assign the id to openinghourid
    $openingHourID = $params['ID'];
    
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
    <title>Edit Opening Hour</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>

<div class="container">
        <h3>Editing Opening Hour for "<?php echo htmlspecialchars(trim($getOpeningHours[0]['Day'])); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="controllers/update.php">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            
            <!-- hidden input to connect to controller and oop -->
            <input type="hidden" name="table" value="OpeningHour">
            <input type="hidden" name="original_OpeningHourID" value="<?php echo htmlspecialchars(trim($openingHourID)); ?>">

            <div class="row">
                <div class="input-field col s6">
                    <input id="Day" name="Day" type="text" value="<?php echo htmlspecialchars(trim($getOpeningHours[0]['Day'])); ?>" class="validate" required="" aria-required="true">
                    <label for="Day">Day</label>
                </div>
                <div class="input-field col s6">
                    <input id="Time" name="Time" type="text" value="<?php echo htmlspecialchars(trim($getOpeningHours[0]['Time'])); ?>" class="validate" required="" aria-required="true">
                    <label for="Time">Time</label>
                </div>
            </div>

            <input type="hidden" name="OpeningHourID" value="<?php echo htmlspecialchars(trim($openingHourID)); ?>">

            <button class="btn waves-effect waves-light" type="submit" name="submit">Update
            </button>
        </form>
    </div>
</div>
</body>
</html>