<?php 
require_once ("includes/dbcon.php");
require_once ("includes/csrfProtection.php");
require_once ("oop/getIDOOP.php");
confirm_is_admin();

// get the role in production id from the url
try {
    // retrieve the id from the url with GetID::getValues
    $params = GetID::getValues(['ID']);
    // assign the id to productionid
    $productionID = $params['ID'];
    
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
    <title>Edit Production</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/dropdown.js" defer></script>
</head>

<body>

    <div class="container">
        <h3>Editing Production for "<?php echo htmlspecialchars(trim($getProduction[0]['FirstName'])) . ' ' . htmlspecialchars(trim($getProduction[0]['LastName'])); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="controllers/update.php">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            
            <!-- hidden input to connect to controller and oop -->
            <input type="hidden" name="table" value="Production">
            <input type="hidden" name="original_ProductionID" value="<?php echo htmlspecialchars(trim($productionID)); ?>">

            <div class="row">
                <div class="input-field col s6">
                    <input id="FirstName" name="FirstName" type="text" value="<?php echo htmlspecialchars(trim($getProduction[0]['FirstName'])); ?>" class="validate" required="" aria-required="true">
                    <label for="FirstName">FirstName</label>
                </div>

                <div class="input-field col s6">
                    <input id="LastName" name="LastName" type="text" value="<?php echo htmlspecialchars(trim($getProduction[0]['LastName'])); ?>" class="validate" required="" aria-required="true">
                    <label for="LastName">LastName</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <p>Name of role</p>
                    <select name="RoleInProductionID" id="RoleInProductionID">
                        <?php
                        include ("controllers/adminController.php");
                        while ($roleInProduction = $roleInProductionQuery->fetch()) {
                            $selected = $roleInProduction['RoleInProductionID'] == $getProduction[0]['RoleInProductionID'] ? 'selected' : '';
                            echo "<option value='{$roleInProduction['RoleInProductionID']}' $selected>{$roleInProduction['NameOfRole']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <input type="hidden" name="ProductionID" value="<?php echo htmlspecialchars(trim($productionID)); ?>">

            <button class="btn waves-effect waves-light" type="submit" name="submit">Update
            </button>
        </form>
    </div>
</div>
</body>
</html>