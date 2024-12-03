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
$userID = htmlspecialchars($_GET['ID']);

$query = $dbCon->prepare("SELECT U.*, A.StreetName, A.StreetNumber, A.PostalCode, A.Country 
                           FROM User U 
                           LEFT JOIN Address A ON U.AddressID = A.AddressID 
                           WHERE U.UserID = :userID");
$query->bindParam(':userID', $userID);
$query->execute();
$getUsers = $query->fetchAll(); 
?>

<body>

<div class="container">
        <h3>Editing user "<?php echo htmlspecialchars($getUsers[0]['Username']); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="crud/user/updateUser.php">
            <div class="row">
                <div class="input-field col s6">
                    <input id="Username" name="Username" type="text" value="<?php echo htmlspecialchars($getUsers[0][1]); ?>" class="validate" required="" aria-required="true">
                    <label for="Username">Username</label>
                </div>

                <div class="input-field col s6">
                    <input id="Pass" name="Pass" type="password" value="<?php echo htmlspecialchars($getUsers[0][1]); ?>" class="validate" required="" aria-required="true">
                    <label for="Pass">Password</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="FirstName" name="FirstName" type="text" value="<?php echo htmlspecialchars($getUsers[0][3]); ?>" class="validate" required="" aria-required="true">
                    <label for="FirstName">First Name</label>
                </div>
                <div class="input-field col s6">
                    <input id="LastName" name="LastName" type="text" value="<?php echo htmlspecialchars($getUsers[0][4]); ?>" class="validate" required="" aria-required="true">
                    <label for="LastName">Last Name</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="Email" name="Email" type="email" value="<?php echo htmlspecialchars($getUsers[0][5]); ?>" class="validate" required="" aria-required="true">
                    <label for="Email">E-Mail</label>
                </div>

                <div class="input-field col s6">
                    <input id="PhoneNumber" name="PhoneNumber" type="number" value="<?php echo htmlspecialchars($getUsers[0][6]); ?>" class="validate" required="" aria-required="true">
                    <label for="PhoneNumber">Phone Number</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="StreetName" name="StreetName" type="text" value="<?php echo htmlspecialchars($getUsers[0][8]); ?>" class="validate" required="" aria-required="true">
                    <label for="StreetName">Street Name</label>
                </div>

                <div class="input-field col s6">
                    <input id="StreetNumber" name="StreetNumber" type="text" value="<?php echo htmlspecialchars($getUsers[0][7]); ?>" class="validate" required="" aria-required="true">
                    <label for="StreetNumber">Street Number</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="PostalCode" name="PostalCode" type="text" value="<?php echo htmlspecialchars($getUsers[0][10]); ?>" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal code</label>
                </div>

                <div class="input-field col s6">
                    <input id="Country" name="Country" type="text" value="<?php echo htmlspecialchars($getUsers[0][11]); ?>" class="validate" required="" aria-required="true">
                    <label for="Country">Country</label>
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
} else {    
    header("Location: ../index.php?page=admin&status=0");
}
?>