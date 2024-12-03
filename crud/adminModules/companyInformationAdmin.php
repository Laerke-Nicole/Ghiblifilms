<?php
// get company information
$queryCompanyInformation = $dbCon->prepare("SELECT C.*, A.StreetName, A.StreetNumber, A.PostalCode, A.Country 
                                            FROM CompanyInformation C 
                                            LEFT JOIN Address A ON C.AddressID = A.AddressID");
$queryCompanyInformation->execute();
$getCompanyInformation = $queryCompanyInformation->fetchAll();
?>


<!-- company information -->
<div class="container">

    <h4>Company information</h4>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The company info " . $_GET['ID'] . " has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The company info " . $_GET['ID'] . " has been successfully Updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new company info has been successfully added!";
            echo "<script>M.toast({html: 'Added!'})</script>";
        } elseif ($_GET['status'] == 0) {
            echo "Forbidden access - redirected to home!";
            echo "<script>M.toast({html: 'Access denied!'})</script>";
        }
    }
    ?>
    <div class="row">
        <div class="row">
            <table class="highlight">
                <thead>
                <tr class="secondary-color">
                    <th>Company ID</th>
                    <th>Company Name</th>
                    <th>Description</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Street name</th>
                    <th>Street number</th>
                    <th>Postal code</th>
                    <th>Country</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody class="secondary-color">
                <?php
                foreach ($getCompanyInformation as $companyInformation) {
                    echo "<tr>";
                    echo "<td>". $companyInformation['CompanyInformationID']."</td>";
                    echo "<td>". $companyInformation['NameOfCompany']."</td>";
                    echo "<td>". $companyInformation['CompanyDescription']."</td>";
                    echo "<td>". $companyInformation['CompanyEmail']."</td>";
                    echo "<td>". $companyInformation['CompanyPhoneNumber']."</td>";
                    echo "<td>". $companyInformation['StreetName']."</td>";
                    echo "<td>". $companyInformation['StreetNumber']."</td>";
                    echo "<td>". $companyInformation['PostalCode']."</td>";
                    echo "<td>". $companyInformation['Country']."</td>";
                    echo "<td>";

                    echo "</td>";

                    echo '<td><a href="index.php?page=editcompanyinformation&ID=' . $companyInformation['CompanyInformationID'] . '" class="waves-effect waves-light btn">Edit</a></td>';
                    echo '<td><a href="index.php?page=deletecompanyinformation&CompanyInformationID=' . $companyInformation['CompanyInformationID'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';

                    echo "</tr>";

                }
                ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h4>Add new company information</h4>

        <form class="col s12" name="contact" method="post" action="crud/companyinformation/addCompanyInformation.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="NameOfCompany" name="NameOfCompany" type="text" class="validate" required="" aria-required="true" class="secondary-color">
                    <label for="NameOfCompany">Company Name</label>
                </div>
            </div>
            
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="CompanyDescription" name="CompanyDescription" class="materialize-textarea" required=""></textarea>
                    <label for="CompanyDescription">Description</label>
                </div>
            </div>  

            <div class="row">
                <div class="input-field col s6">
                    <input id="CompanyEmail" name="CompanyEmail" type="email" class="validate" required="" aria-required="true">
                    <label for="CompanyEmail">E-Mail</label>
                </div>

                <div class="input-field col s6">
                    <input id="CompanyPhoneNumber" name="CompanyPhoneNumber" type="number" class="validate" required="" aria-required="true">
                    <label for="CompanyPhoneNumber">Phone number</label>
                </div>
            </div>  

            <div class="row">
                <div class="input-field col s6">
                    <input id="StreetName" name="StreetName" type="text" class="validate" required="" aria-required="true">
                    <label for="StreetName">Street Name</label>
                </div>

                <div class="input-field col s6">
                    <input id="StreetNumber" name="StreetNumber" type="text" class="validate" required="" aria-required="true">
                    <label for="StreetNumber">Street Number</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="PostalCode" name="PostalCode" type="text" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal Code</label>
                </div>
                
                <div class="input-field col s6">
                    <input id="Country" name="Country" type="text" class="validate" required="" aria-required="true">
                    <label for="Country">Country</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="submit">Add
            </button>
        </form>
    </div>
</div>