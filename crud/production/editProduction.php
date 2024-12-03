<?php 
require_once "includes/dbcon.php";

if (isset($_GET['ID'])) {
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
</head>

<?php
$productionID = htmlspecialchars($_GET['ID']);
$query = $dbCon->prepare("SELECT * FROM Production WHERE ProductionID = :productionID");
$query->bindParam(':productionID', $productionID);
$query->execute();
$getProduction = $query->fetchAll();
?>

<body>

    <div class="container">
        <h3>Editing Production for "<?php echo htmlspecialchars($getProduction[0]['FirstName'] . ' ' . $getProduction[0]['LastName']); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="crud/production/updateProduction.php">
            <div class="row">
                <div class="input-field col s6">
                    <input id="FirstName" name="FirstName" type="text" value="<?php echo htmlspecialchars($getProduction[0]['FirstName']); ?>" class="validate" required="" aria-required="true">
                    <label for="FirstName">FirstName</label>
                </div>

                <div class="input-field col s6">
                    <input id="LastName" name="LastName" type="text" value="<?php echo htmlspecialchars($getProduction[0]['LastName']); ?>" class="validate" required="" aria-required="true">
                    <label for="LastName">LastName</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="RoleInProductionID" name="RoleInProductionID" type="text" value="<?php echo htmlspecialchars($getProduction[0]['RoleInProductionID']); ?>" class="validate" required="" aria-required="true">
                    <label for="RoleInProductionID">RoleInProductionID</label>
                </div>
            </div>

            <input type="hidden" name="ProductionID" value="<?php echo htmlspecialchars($productionID); ?>">

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