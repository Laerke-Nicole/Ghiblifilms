<?php 
require_once "includes/dbcon.php";
confirm_logged_in();

if (isset($_GET['ID'])) {

// get the company info to edit
$companyInformationID = htmlspecialchars(trim($_GET['ID']));
$query = $dbCon->prepare("SELECT C.*, A.StreetName, A.StreetNumber, A.PostalCode, A.Country 
                           FROM CompanyInformation C 
                           LEFT JOIN Address A ON C.AddressID = A.AddressID 
                           WHERE C.CompanyInformationID = :CompanyInformationID");
$query->bindParam(':CompanyInformationID', $companyInformationID);
$query->execute();
$getCompanyInformation = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit company info</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>

<div class="container">
        <h3>Editing company information "<?php echo htmlspecialchars(trim($getCompanyInformation[0][1])); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="controllers/update.php">
            <!-- hidden input to connect to controller and oop -->
            <input type="hidden" name="table" value="CompanyInformation">
            <input type="hidden" name="original_CompanyInformationID" value="<?php echo htmlspecialchars(trim($companyInformationID)); ?>">

            <div class="row">
                <div class="input-field col s12">
                    <input id="NameOfCompany" name="NameOfCompany" type="text" value="<?php echo htmlspecialchars(trim($getCompanyInformation[0][1])); ?>" class="validate" required="" aria-required="true">
                    <label for="NameOfCompany" class="active">Company Name</label>
                </div>
            </div>
            
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="CompanyDescription" name="CompanyDescription" class="materialize-textarea" required=""><?php echo htmlspecialchars(trim($getCompanyInformation[0][2])); ?></textarea>
                    <label for="CompanyDescription" class="active">Description</label>
                </div>
            </div>  

            <div class="row">
                <div class="input-field col s6">
                    <input id="CompanyEmail" name="CompanyEmail" type="email" value="<?php echo htmlspecialchars(trim($getCompanyInformation[0][3])); ?>" class="validate" required="">
                    <label for="CompanyEmail" class="active">E-Mail</label>
                </div>

                <div class="input-field col s6">
                    <input id="CompanyPhoneNumber" name="CompanyPhoneNumber" type="number" value="<?php echo htmlspecialchars(trim($getCompanyInformation[0][4])); ?>" class="validate" required="">
                    <label for="CompanyPhoneNumber" class="active">Phone number</label>
                </div>
            </div>  

            <div class="row">
                <div class="input-field col s6">
                    <input id="StreetName" name="fk_Address_StreetName" type="text" value="<?php echo htmlspecialchars(trim($getCompanyInformation[0][6])); ?>" class="validate" required="" aria-required="true">
                    <label for="StreetName">Street Name</label>
                </div>

                <div class="input-field col s6">
                    <input id="StreetNumber" name="fk_Address_StreetNumber" type="text" value="<?php echo htmlspecialchars(trim($getCompanyInformation[0][7])); ?>" class="validate" required="" aria-required="true">
                    <label for="StreetNumber">Street Number</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="PostalCode" name="fk_Address_PostalCode" type="text" value="<?php echo htmlspecialchars(trim($getCompanyInformation[0][8])); ?>" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal code</label>
                </div>

                <div class="input-field col s6">
                    <input id="Country" name="fk_Address_Country" type="text" value="<?php echo htmlspecialchars(trim($getCompanyInformation[0][9])); ?>" class="validate" required="" aria-required="true">
                    <label for="Country">Country</label>
                </div>
            </div>

            <input type="hidden" name="CompanyInformationID" value="<?php echo htmlspecialchars(trim($companyInformationID)); ?>">

            <button class="btn waves-effect waves-light" type="submit" name="submit">Update</button>
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