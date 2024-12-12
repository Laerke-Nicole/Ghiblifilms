<?php 
require_once ("includes/dbcon.php");
require_once ("includes/csrfProtection.php");
confirm_logged_in();

if (isset($_GET['ID'])) {

// get the postal code to edit
$postalCode = htmlspecialchars(trim($_GET['ID']));

$query = $dbCon->prepare("SELECT * FROM PostalCode WHERE PostalCode = :postalCode");
$query->bindParam(':postalCode', $postalCode);
$query->execute();
$getPostalCode = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Postal Code</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>

<div class="container">
        <h3>Editing postal code for "<?php echo htmlspecialchars(trim($getPostalCode[0][1])); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="controllers/update.php">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            
            <!-- hidden input to connect to controller and oop -->
            <input type="hidden" name="table" value="PostalCode">
            <input type="hidden" name="original_PostalCode" value="<?php echo htmlspecialchars(trim($postalCode)); ?>">

            <div class="row">
                <div class="input-field col s6">
                    <input id="PostalCode" name="PostalCode" type="text" value="<?php echo htmlspecialchars(trim($getPostalCode[0]['PostalCode'])); ?>" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal code</label>
                </div>
                <div class="input-field col s6">
                    <input id="City" name="City" type="text" value="<?php echo htmlspecialchars(trim($getPostalCode[0]['City'])); ?>" class="validate" required="" aria-required="true">
                    <label for="City">City</label>
                </div>
            </div>

            <input type="hidden" name="PostalCode" value="<?php echo htmlspecialchars(trim($postalCode)); ?>">

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