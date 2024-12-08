<?php
confirm_logged_in();

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
                    echo "<td>". htmlspecialchars(trim($companyInformation['CompanyInformationID'])) . "</td>";
                    echo "<td>". htmlspecialchars(trim($companyInformation['NameOfCompany'])) . "</td>";
                    echo "<td>". htmlspecialchars(trim($companyInformation['CompanyDescription'])) . "</td>";
                    echo "<td>". htmlspecialchars(trim($companyInformation['CompanyEmail'])) . "</td>";
                    echo "<td>". htmlspecialchars(trim($companyInformation['CompanyPhoneNumber'])) . "</td>";
                    echo "<td>". htmlspecialchars(trim($companyInformation['StreetName'])) . "</td>";
                    echo "<td>". htmlspecialchars(trim($companyInformation['StreetNumber'])) . "</td>";
                    echo "<td>". htmlspecialchars(trim($companyInformation['PostalCode'])) . "</td>";
                    echo "<td>". htmlspecialchars(trim($companyInformation['Country'])) . "</td>";
                    echo "<td>";

                    echo "</td>";

                    echo '<td><a href="index.php?page=editcompanyinformation&ID=' . htmlspecialchars(trim($companyInformation['CompanyInformationID'])) . '" class="waves-effect waves-light btn">Edit</a></td>';
                    echo '<td><a href="index.php?page=deletecompanyinformation&CompanyInformationID=' . htmlspecialchars(trim($companyInformation['CompanyInformationID'])) . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';

                    echo "</tr>";

                }
                ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h4>Add new company information</h4>

        <form class="col s12" name="contact" method="post" action="controllers/create.php">
            <!-- to tell create.php which table to insert data into -->
            <input type="hidden" name="table" value="CompanyInformation">
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
                    <input id="StreetName" name="fk_Address_StreetName" type="text" class="validate" required="" aria-required="true">
                    <label for="StreetName">Street Name</label>
                </div>

                <div class="input-field col s6">
                    <input id="StreetNumber" name="fk_Address_StreetNumber" type="text" class="validate" required="" aria-required="true">
                    <label for="StreetNumber">Street Number</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="PostalCode" name="fk_Address_PostalCode" type="text" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal Code</label>
                </div>
                
                <div class="input-field col s6">
                    <input id="Country" name="fk_Address_Country" type="text" class="validate" required="" aria-required="true">
                    <label for="Country">Country</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="submit">Add
            </button>
        </form>
    </div>
</div>