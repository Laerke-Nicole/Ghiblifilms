<?php require_once "dbcon.php";?>
<?php require_once "adminModules/userAdmin.php";?>


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

<?php include 'crud/adminModules/userAdmin.php'; ?>


<?php

// connect to db
$dbCon = dbCon($user, $pass);


// get users
$queryUser = $dbCon->prepare("SELECT * FROM User");
$queryUser->execute();
$getUsers = $queryUser->fetchAll();
//var_dump($getUsers);

// get movies
$queryMovie = $dbCon->prepare("SELECT * FROM Movie");
$queryMovie->execute();
$getMovies = $queryMovie->fetchAll();

// get news
$queryNews = $dbCon->prepare("SELECT * FROM News");
$queryNews->execute();
$getNews = $queryNews->fetchAll();

// get company information
$queryCompanyInformation = $dbCon->prepare("SELECT * FROM CompanyInformation");
$queryCompanyInformation->execute();
$getCompanyInformation = $queryCompanyInformation->fetchAll();

?>
<body>



<br>
<br>
<br>
<br>
<br>


<!-- movie -->
<div class="container">

    <h2>All movies</h2>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The movie " . $_GET['ID'] . " has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The movie " . $_GET['ID'] . " has been successfully Updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new movie has been successfully added!";
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
                    <th>MovieID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Release year</th>
                    <th>Duration</th>
                    <th>Movie Image</th>
                    <th>ScreenFormatID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody class="secondary-color">
                <?php
                foreach ($getMovies as $getMovie) {
                    echo "<tr>";
                    echo "<td>". $getMovie['MovieID']."</td>";
                    echo "<td>". $getMovie['Name']."</td>";
                    echo "<td>". $getMovie['Description']."</td>";
                    echo "<td>". $getMovie['ReleaseYear']."</td>";
                    echo "<td>". $getMovie['Duration']."</td>";
                    echo "<td><img src='" . $getMovie['MovieImg'] . "' alt='Movie Image' width='50'></td>";
                    echo "<td>". $getMovie['ScreenFormatID']."</td>";
                    echo "<td>";

                    echo "</td>";
                    echo '<td><a href="index.php?page=editmovie&ID='.$getMovie['MovieID'].'" class="btn">Edit</a></td>';
                    echo '<td><a href="crud/deleteMovie.php?MovieID='.$getMovie['MovieID'].'" class=" btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';

                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>



        <hr>
        <h3>Add new movie</h3>

        <form class="col s12" method="post" action="crud/addMovie.php" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12">
                    <input id="Name" name="Name" type="text" class="validate" required>
                    <label for="Name">Movie Name</label>
                </div>
            </div>
            
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="Description" name="Description" class="materialize-textarea" required></textarea>
                    <label for="Description">Description</label>
                </div>
            </div>  

            <div class="row">
                <div class="input-field col s6">
                    <input id="ReleaseYear" name="ReleaseYear" type="number" class="validate" required>
                    <label for="ReleaseYear">Release Year</label>
                </div>

                <div class="input-field col s6">
                    <input id="Duration" name="Duration" type="text" class="validate" required>
                    <label for="Duration">Duration</label>
                </div>
            </div>

            <div class="row">
                <div class="file-field input-field col s6">
                    <div class="btn">
                        <span>Upload Image</span>
                        <input type="file" name="MovieImage" required>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload movie image">
                    </div>
                </div>

                <div class="input-field col s6">
                    <input id="ScreenFormatID" name="ScreenFormatID" type="text" class="validate" required>
                    <label for="ScreenFormatID">Screen Format ID</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="submit">Add Movie</button>
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
            echo "The news " . $_GET['ID'] . " has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The news " . $_GET['ID'] . " has been successfully Updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new news has been successfully added!";
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

                echo '<td><a href="crud/editNews.php?ID=' . $news['NewsID'] . '" class="waves-effect waves-light btn">Edit</a></td>';
                echo '<td><a href="crud/deleteNews.php?NewsID=' . $news['NewsID'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
 
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
        <h3>Add New News</h3>
        <form class="col s12" name="contact" method="post" action="crud/addNews.php" enctype="multipart/form-data">
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
                    <th>Address</th>
                    <th>Postal code</th>
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
                    echo "<td>". $companyInformation['AddressOfCompany']."</td>";
                    echo "<td>". $companyInformation['PostalCode']."</td>";
                    echo "<td>";

                    echo "</td>";

                    echo '<td><a href="crud/editCompanyInformation.php?ID=' . $companyInformation['CompanyInformationID'] . '" class="waves-effect waves-light btn">Edit</a></td>';
                    echo '<td><a href="crud/deleteCompanyInformation.php?CompanyInformationID=' . $companyInformation['CompanyInformationID'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
     
                    echo "</tr>";

                }
                ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h3>Add new company information</h3>

        <form class="col s12" name="contact" method="post" action="crud/addCompanyInformation.php">
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