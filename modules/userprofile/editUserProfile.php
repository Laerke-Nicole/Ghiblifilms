<?php 
require_once "includes/dbcon.php";
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
require_once ("includes/csrfProtection.php");
require_once("controllers/userController.php");
require_once ("oop/getIDOOP.php");
confirm_logged_in();

// get the user id from the url
try {
    // retrieve the id from the url with GetID::getValues
    $params = GetID::getValues(['ID']);
    // assign the id to userid
    $userID = $params['ID'];
    
// check if the user is the same as the logged in user
} catch (Exception $e) { 
    header("Location: ../index.php?page=admin&status=0");
    exit;
}

include ("controllers/userController.php");

// if the userprofileview cant be found
if (!$getUserProfileView) {
    die("No profile found.");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit user</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>
<div class="container">
        <h3>Editing user "<?php echo htmlspecialchars(trim($getUserProfileView[0]['Username'])); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="controllers/update.php">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">

            <!-- hidden input to connect to controller and oop -->
            <input type="hidden" name="table" value="User">
            <input type="hidden" name="original_UserID" value="<?php echo htmlspecialchars(trim($userID)); ?>">
            <input type="hidden" name="redirect" value="userprofile">

            <div class="row">
                <div class="input-field col s12">
                    <input id="Username" name="Username" type="text" value="<?php echo htmlspecialchars(trim($getUserProfileView[0][1])); ?>" class="validate" required="" aria-required="true">
                    <label for="Username">Username</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="FirstName" name="FirstName" type="text" value="<?php echo htmlspecialchars(trim($getUserProfileView[0][2])); ?>" class="validate" required="" aria-required="true">
                    <label for="FirstName">First Name</label>
                </div>
                <div class="input-field col s6">
                    <input id="LastName" name="LastName" type="text" value="<?php echo htmlspecialchars(trim($getUserProfileView[0][3])); ?>" class="validate" required="" aria-required="true">
                    <label for="LastName">Last Name</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="Email" name="Email" type="email" value="<?php echo htmlspecialchars(trim($getUserProfileView[0][4])); ?>" class="validate" required="" aria-required="true">
                    <label for="Email">E-Mail</label>
                </div>

                <div class="input-field col s6">
                    <input id="PhoneNumber" name="PhoneNumber" type="number" value="<?php echo htmlspecialchars(trim($getUserProfileView[0][5])); ?>" class="validate" required="" aria-required="true">
                    <label for="PhoneNumber">Phone Number</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="StreetName" name="fk_Address_StreetName" type="text" value="<?php echo htmlspecialchars(trim($getUserProfileView[0][6])); ?>" class="validate" required="" aria-required="true">
                    <label for="StreetName">Street Name</label>
                </div>

                <div class="input-field col s6">
                    <input id="StreetNumber" name="fk_Address_StreetNumber" type="text" value="<?php echo htmlspecialchars(trim($getUserProfileView[0][7])); ?>" class="validate" required="" aria-required="true">
                    <label for="StreetNumber">Street Number</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="PostalCode" name="fk_Address_PostalCode" type="text" value="<?php echo htmlspecialchars(trim($getUserProfileView[0][9])); ?>" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal code</label>
                </div>

                <div class="input-field col s6">
                    <input id="Country" name="fk_Address_Country" type="text" value="<?php echo htmlspecialchars(trim($getUserProfileView[0][8])); ?>" class="validate" required="" aria-required="true">
                    <label for="Country">Country</label>
                </div>
            </div>
            
            <input type="hidden" name="UserID" value="<?php echo htmlspecialchars(trim($userID)); ?>">

            <button class="btn waves-effect waves-light" type="submit" name="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>