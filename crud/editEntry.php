<?php require_once "dbcon.php";
if (isset($_GET['ID'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit entry</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<?php
$entryID = $_GET['ID'];
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM User WHERE UserID=$entryID");

$query->execute();
$getUsers = $query->fetchAll();
?>
<body>

<div class="container">
        <h3>Editing user "<?php echo $getUsers[0][1]; ?>"</h3>
        <form class="col s12" name="contact" method="post" action="updateEntry.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="Username" name="Username" type="text" value="<?php echo $getUsers[0][1]; ?>" class="validate" required="" aria-required="true">
                    <label for="Username">Username</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="FirstName" name="FirstName" type="text" value="<?php echo $getUsers[0][3]; ?>" class="validate" required="" aria-required="true">
                    <label for="FirstName">First Name</label>
                </div>
                <div class="input-field col s6">
                    <input id="LastName" name="LastName" type="text" value="<?php echo $getUsers[0][4]; ?>" class="validate" required="" aria-required="true">
                    <label for="LastName">Last Name</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="Email" name="Email" type="email" value="<?php echo $getUsers[0][5]; ?>" class="validate" required="" aria-required="true">
                    <label for="Email">E-Mail</label>
                </div>

                <div class="input-field col s6">
                    <input id="PhoneNumber" name="PhoneNumber" type="number" value="<?php echo $getUsers[0][6]; ?>" class="validate" required="" aria-required="true">
                    <label for="PhoneNumber">Phone Number</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="Address" name="Address" type="text" value="<?php echo $getUsers[0][7]; ?>" class="validate" required="" aria-required="true">
                    <label for="Address">Address</label>
                </div>

                <div class="input-field col s6">
                    <input id="PostalCode" name="PostalCode" type="text" value="<?php echo $getUsers[0][8]; ?>" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal code</label>
                </div>
            </div>
            
            <input type="hidden" name="UserID" value="<?php echo $userID; ?>">

            <button class="btn waves-effect waves-light" type="submit" name="submit">Update
            </button>
        </form>
    </div>
</div>
</body>
</html>
<?php 

}

else{    header("Location: admin.php?status=0");
}?>