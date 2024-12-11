<?php 
require_once ("includes/dbcon.php");
require_once ("includes/csrfProtection.php");
confirm_logged_in();

if (isset($_GET['ID'])) {

// get the production to edit
$roleInProductionID = htmlspecialchars(trim($_GET['ID']));
$query = $dbCon->prepare("SELECT * FROM RoleInProduction WHERE RoleInProductionID = :roleInProductionID");
$query->bindParam(':roleInProductionID', $roleInProductionID);
$query->execute();
$getRoleInProduction = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Role In Production</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>

<div class="container">
        <h3>Editing Role In Production for "<?php echo htmlspecialchars(trim($getRoleInProduction[0]['NameOfRole'])); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="controllers/update.php">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            
            <!-- hidden input to connect to controller and oop -->
            <input type="hidden" name="table" value="RoleInProduction">
            <input type="hidden" name="original_RoleInProductionID" value="<?php echo htmlspecialchars(trim($roleInProductionID)); ?>">

            <div class="row">
                <div class="input-field col s12">
                    <input id="NameOfRole" name="NameOfRole" type="text" value="<?php echo htmlspecialchars(trim($getRoleInProduction[0]['NameOfRole'])); ?>" class="validate" required="" aria-required="true">
                    <label for="NameOfRole">NameOfRole</label>
                </div>
            </div>

            <input type="hidden" name="RoleInProductionID" value="<?php echo htmlspecialchars(trim($roleInProductionID)); ?>">

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