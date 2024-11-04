<?php 
require_once "includes/dbcon.php";
if (isset($_GET['ID'])) {
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

<?php
$userID = htmlspecialchars($_GET['ID'], ENT_QUOTES, 'UTF-8');
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM User WHERE UserID = :userID");
$query->bindParam(':userID', $userID, PDO::PARAM_INT);
$query->execute();
$getUsers = $query->fetchAll();
?>

<body>

<div class="container">
        <h3>Editing user "<?php echo $getUsers[0][1]; ?>"</h3>
        <form class="col s12" name="contact" method="post" action="crud/user/updateUser.php">
            <div class="row">
                <div class="input-field col s6">
                    <input id="FirstName" name="FirstName" type="text" value="<?php echo htmlspecialchars($getUsers[0][1]); ?>" class="validate" required="" aria-required="true">
                    <label for="FirstName">First Name</label>
                </div>
                <div class="input-field col s6">
                    <input id="LastName" name="LastName" type="text" value="<?php echo htmlspecialchars($getUsers[0][2]); ?>" class="validate" required="" aria-required="true">
                    <label for="LastName">Last Name</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="Email" name="Email" type="email" value="<?php echo htmlspecialchars($getUsers[0][3]); ?>" class="validate" required="" aria-required="true">
                    <label for="Email">E-Mail</label>
                </div>

                <div class="input-field col s6">
                    <input id="PhoneNumber" name="PhoneNumber" type="number" value="<?php echo htmlspecialchars($getUsers[0][4]); ?>" class="validate" required="" aria-required="true">
                    <label for="PhoneNumber">Phone Number</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="Address" name="Address" type="text" value="<?php echo htmlspecialchars($getUsers[0][5]); ?>" class="validate" required="" aria-required="true">
                    <label for="Address">Address</label>
                </div>

                <div class="input-field col s6">
                    <input id="PostalCode" name="PostalCode" type="text" value="<?php echo htmlspecialchars($getUsers[0][6]); ?>" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal code</label>
                </div>
            </div>
            
            <input type="hidden" name="UserID" value="<?php echo htmlspecialchars($userID); ?>">

            <button class="btn waves-effect waves-light" type="submit" name="submit">Update
            </button>
        </form>
    </div>
</div>
</body>
</html>
<?php 

}

else {    
    header("Location: ../index.php?page=admin&status=0");
}?>