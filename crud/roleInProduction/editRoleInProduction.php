<?php 
require_once "includes/dbcon.php";

if (isset($_GET['ID'])) {
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

<?php
$roleInProductionID = htmlspecialchars($_GET['ID']);
$query = $dbCon->prepare("SELECT * FROM RoleInProduction WHERE RoleInProductionID = :roleInProductionID");
$query->bindParam(':roleInProductionID', $roleInProductionID);
$query->execute();
$getRoleInProduction = $query->fetchAll();
?>

<body>

<div class="container">
        <h3>Editing Role In Production for "<?php echo htmlspecialchars($getRoleInProduction[0]['NameOfRole']); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="crud/roleInProduction/updateRoleInProduction.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="NameOfRole" name="NameOfRole" type="text" value="<?php echo htmlspecialchars($getRoleInProduction[0]['NameOfRole']); ?>" class="validate" required="" aria-required="true">
                    <label for="NameOfRole">NameOfRole</label>
                </div>
            </div>

            <input type="hidden" name="RoleInProductionID" value="<?php echo htmlspecialchars($roleInProductionID); ?>">

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