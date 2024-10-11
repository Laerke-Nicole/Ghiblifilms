<?php require_once "dbcon.php";?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin page</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/ghiblifilms/style/style.css">
    <link rel="stylesheet" href="/ghiblifilms/style/responsive.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<?php
// get users
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM User");
$query->execute();
$getUsers = $query->fetchAll();
//var_dump($getUsers);

// get news
$queryNews = $dbCon->prepare("SELECT * FROM News");
$queryNews->execute();
$getNews = $queryNews->fetchAll();

// get company information
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM CompanyInformation");
$query->execute();
$getCompanies = $query->fetchAll();

?>
<body>


<!-- user -->
<div class="container">

    <h2>All users</h2>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The entry " . $_GET['ID'] . " has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The entry " . $_GET['ID'] . " has been successfully Updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new entry has been successfully added!";
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
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Address</th>
                    <th>Postal code</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody class="secondary-color">
                <?php
                foreach ($getUsers as $getUser) {
                    echo "<tr>";
                    echo "<td>". $getUser['UserID']."</td>";
                    echo "<td>". $getUser['Username']."</td>";
                    echo "<td>". $getUser['FirstName']. " " .$getUser['LastName']."</td>";
                    echo "<td>". $getUser['Email']."</td>";
                    echo "<td>". $getUser['PhoneNumber']."</td>";
                    echo "<td>". $getUser['Address']."</td>";
                    echo "<td>". $getUser['PostalCode']."</td>";
                    echo "<td>";

                    echo "</td>";
                    echo '<td><a href="editEntry.php?ID='.$getUser['UserID'].'" class="btn" ">Edit</a></td>';
                    echo '<td><a href="crud/deleteEntry.php?UserID='.$getUser['UserID'].'" class=" btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';

                    
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h3>Add new user</h3>

        <form class="col s12" name="contact" method="post" action="crud/addEntry.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="Username" name="Username" type="text" class="validate" required="" aria-required="true" class="secondary-color">
                    <label for="Username">Username</label>
                </div>
            </div>
            
            <div class="row">
                <div class="input-field col s6">
                    <input id="FirstName" name="FirstName" type="text" class="validate" required="" aria-required="true">
                    <label for="FirstName">First Name</label>
                </div>
                
                <div class="input-field col s6">
                    <input id="LastName" name="LastName" type="text" class="validate" required="" aria-required="true">
                    <label for="LastName">Last Name</label>
                </div>
            </div>  

            <div class="row">
                <div class="input-field col s6">
                        <input id="Email" name="Email" type="email" class="validate" required="" aria-required="true">
                        <label for="Email">E-Mail</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="PhoneNumber" name="PhoneNumber" type="number" class="validate" required="" aria-required="true">
                        <label for="PhoneNumber">Phone number</label>
                    </div>
                </div>  
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="Address" name="Address" type="text" class="validate" required="" aria-required="true">
                    <label for="Address">Address</label>
                </div>

                <div class="input-field col s6">
                    <input id="PostalCode" name="PostalCode" type="text" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal code</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="submit">Add
            </button>
        </form>
    </div>
</div>


<br>
<br>
<br>
<br>
<br>


<!-- news -->
<div class="container">

    <h2>All news</h2>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The entry " . $_GET['ID'] . " has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The entry " . $_GET['ID'] . " has been successfully Updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new entry has been successfully added!";
            echo "<script>M.toast({html: 'Added!'})</script>";
        } elseif ($_GET['status'] == 0) {
            echo "Forbidden access - redirected to home!";
            echo "<script>M.toast({html: 'Access denied!'})</script>";
        }
    }
    ?>




    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>NewsID</th>
                <th>Headline</th>
                <th>SubHeadline</th>
                <th>Text</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            foreach ($getNews as $news) {
                echo "<tr>";
                echo "<td>" . $news['NewsID'] . "</td>";
                echo "<td>" . $news['Headline'] . "</td>";
                echo "<td>" . $news['SubHeadline'] . "</td>";
                echo "<td>" . $news['TextOfNews'] . "</td>";
                echo "<td><img src='" . $news['NewsImage'] . "' alt='Image of news' width='100'></td>";
                echo '<td><a href="editNews.php?ID=' . $news['NewsID'] . '" class="waves-effect waves-light btn">Edit</a></td>';
                echo '<td><a href="deleteNews.php?NewsID=' . $news['NewsID'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
        <h3>Add New News</h3>
        <form class="col s12" name="contact" method="post" action="addNews.php" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12">
                    <input id="Headline" name="Headline" type="text" class="validate" required="" aria-required="true">
                    <label for="Headline">Headline</label>
                </div>
            </div>
            
            <div class="row">
                <div class="input-field col s12">
                    <input id="SubHeadline" name="SubHeadline" type="text" class="validate" required="" aria-required="true">
                    <label for="SubHeadline">Subheadline</label>
                </div>
            </div>  

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="TextOfNews" name="TextOfNews" class="materialize-textarea" required="" aria-required="true"></textarea>
                    <label for="TextOfNews">Text of news</label>
                </div>
            </div>   
            
            <div class="row">
                <div class="input-field col s12">
                    <input id="NewsImage" name="NewsImage" type="file" class="validate" required="" aria-required="true">
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="submit">Add News</button>
        </form>

    </div>
</div>


<br>
<br>
<br>
<br>
<br>


<!-- company information -->
<div class="container">

    <h2>Company information</h2>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The entry " . $_GET['ID'] . " has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The entry " . $_GET['ID'] . " has been successfully Updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new entry has been successfully added!";
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
                    <th>Address</th>
                    <th>Postal code</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody class="secondary-color">
                <?php
                foreach ($getCompanies as $companyInformation) {
                    echo "<tr>";
                    echo "<td>". $companyInformation['CompanyInformationID']."</td>";
                    echo "<td>". $companyInformation['NameOfCompany']."</td>";
                    echo "<td>". $companyInformation['CompanyDescription']."</td>";
                    echo "<td>". $companyInformation['CompanyEmail']."</td>";
                    echo "<td>". $companyInformation['CompanyPhoneNumber']."</td>";
                    echo "<td>". $companyInformation['AddressOfCompany']."</td>";
                    echo "<td>". $companyInformation['PostalCode']."</td>";
                    echo "<td>";

                    echo "</td>";
                    echo '<td><a href="editCompanyInformation.php?ID='.$companyInformation['CompanyInformationID'].'" class="btn" ">Edit</a></td>';
                    echo '<td><a href="deleteCompanyInformation.php?CompanyInformationID='.$companyInformation['CompanyInformationID'].'" class="btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';

                    echo "</tr>";

                }
                ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h3>Add new company information</h3>

        <form class="col s12" name="contact" method="post" action="addCompanyInformation.php">
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
                    <input id="AddressOfCompany" name="AddressOfCompany" type="text" class="validate" required="" aria-required="true">
                    <label for="AddressOfCompany">Address</label>
                </div>

                <div class="input-field col s6">
                    <input id="PostalCode" name="PostalCode" type="text" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal code</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="submit">Add
            </button>
        </form>
    </div>
</div>

</body>
</html>