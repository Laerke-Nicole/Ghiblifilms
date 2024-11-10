<?php require_once("includes/session.php"); ?>
<!-- cookies -->
<?php 
// create cookie
// if (!isset($_COOKIE["user"])) {
//     setcookie("user", "Lærke Nielsen", time() + 3600);
// }

// expiration time to delete cookie
// if (isset($_GET['delete'])) {
//     $expire = time() + 60*60*24*30;
//     setcookie("user", "", $expire); 
// }
// ?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/library.css">
    <link rel="stylesheet" href="style/responsive.css">
</head>

<body>
<!-- <?php 
// Retrieve the cookie
if (isset($_COOKIE["user"])) {
    echo "Welcome " . htmlspecialchars($_COOKIE["user"]) . "!<br>";
} else {
    echo "Welcome guest!<br>";
}

// print a cookie
echo $_COOKIE["user"];

echo "<br>";

// View all cookies for debugging
print_r($_COOKIE);
?> -->


<nav class="flex justify-between items-center p-6">
    <!-- empty div for left side alignment -->
    <div></div>

    <a href="index.php?page=home" class="secondary-color text-3xl caps">Ghiblifilms</a>

    <ul class="flex gap-6">
        
        <li><a href="index.php?page=login" class="secondary-color">Log in</a></li>
        <li><a href="index.php?page=newuser" class="secondary-color">New user</a></li>
        <li><a href="index.php?page=logout" class="secondary-color">Log out</a></li>
        <li><a href="index.php?page=profilepage" class="secondary-color">Profile Page</a></li>
        <li><a href="index.php?page=admin" class="secondary-color">Admin page</a></li>

        <!-- show log out btn if ur logged in -->
        <?php if (logged_in()) { ?>
            <form action="logout.php" method="post" style="display:inline;">
                <input type="submit" value="Log Out" class="btn">
            </form>
        <?php } ?>


        <!-- <?php
        $_SESSION['User'] = 'admin'; 
        $_SESSION['Pass'] = '123456'; 

        if (isset($_SESSION['User']) && $_SESSION['User'] === "admin" && isset($_SESSION['Pass']) && $_SESSION['Pass'] === "123456") {
            ?>
            <form action="crud/admin.php" method="post" style="display:inline;">
                <input type="submit" value="Admin page" class="btn">
            </form>
        <?php
        }
        ?> -->

    </ul>
</nav>



<?php
if (isset($_GET['page'])){
	$page = $_GET['page'];
	} else{
		$page = "index";}

switch($page) {

default:
    include('home.php');
break;

case "login":
    include('login.php');
break;

case "newuser":
    include('newuser.php');
break;

case "admin":
    include('crud/admin.php');
break;

case "profilepage":
    include('views/profilePage.php');
break;

case "form":
    include('modules/contactform/form.php');
break;


// admin modules of cruds
case "postalcodeadmin":
    include('crud/adminModules/postalCodeAdmin.php');
break;

case "genreadmin":
    include('crud/adminModules/genreAdmin.php');
break;

case "roleinproductionadmin":
    include('crud/adminModules/roleInProductionAdmin.php');
break;

case "productionadmin":
    include('crud/adminModules/productionAdmin.php');
break;

case "voiceactoradmin":
    include('crud/adminModules/voiceActorAdmin.php');
break;

case "movieadmin":
    include('crud/adminModules/movieAdmin.php');
break;

case "moviegenreadmin":
    include('crud/adminModules/movieGenreAdmin.php');
break;

case "movieproductionadmin":
    include('crud/adminModules/movieProductionAdmin.php');
break;

case "voiceactoradmin":
    include('crud/adminModules/voiceActorAdmin.php');
break;

case "premiereadmin":
    include('crud/adminModules/premiereAdmin.php');
break;

case "useradmin":
    include('crud/adminModules/userAdmin.php');
break;

case "newsadmin":
    include('crud/adminModules/newsAdmin.php');
break;

case "companyinformationadmin":
    include('crud/adminModules/companyInformationAdmin.php');
break;

case "openinghour":
    include('crud/adminModules/openingHourAdmin.php');
break;


// add
case "addpostalcode":
    include('crud/postalCode/addPostalCode.php');
break;

case "addgenre":
    include('crud/genre/addGenre.php');
break;

case "addroleinproduction":
    include('crud/roleInProduction/addRoleInProduction.php');
break;

case "addproduction":
    include('crud/production/addProduction.php');
break;

case "addvoiceactor":
    include('crud/voiceActor/addVoiceActor.php');
break;

case "addmovie":
    include('crud/movie/addMovie.php');
break;

case "addmoviegenre":
    include('crud/movieGenre/addMovieGenre.php');
break;

case "addmovieproduction":
    include('crud/movieProduction/addMovieProduction.php');
break;

case "addmovievoiceactor":
    include('crud/movieVoiceActor/addMovieVoiceActor.php');
break;

case "addpremiere":
    include('crud/premiere/addPremiere.php');
break;

case "adduser":
    include('crud/user/addUser.php');
break;

case "addnews":
    include('crud/news/addNews.php');
break;

case "addcompanyinformation":
    include('crud/companyinformation/addCompanyInformation.php');
break;

case "addopeninghour":
    include('crud/openinghour/addOpeningHour.php');
break;


// delete
case "deletepostalcode":
    include('crud/postalCode/deletePostalCode.php');
break;

case "deletegenre":
    include('crud/genre/deleteGenre.php');
break;

case "deleteroleinproduction":
    include('crud/roleInProduction/deleteRoleInProduction.php');
break;

case "deleteproduction":
    include('crud/production/deleteProduction.php');
break;

case "deletevoiceactor":
    include('crud/voiceActor/deleteVoiceActor.php');
break;

case "deletemovie":
    include('crud/movie/deleteMovie.php');
break;

case "deletemoviegenre":
    include('crud/movieGenre/deleteMovieGenre.php');
break;

case "deletemovieproduction":
    include('crud/movieProduction/deleteMovieProduction.php');
break;

case "deletemovievoiceactor":
    include('crud/movieVoiceActor/deleteMovieVoiceActor.php');
break;

case "deletepremiere":
    include('crud/premiere/deletePremiere.php');
break;

case "deleteuser":
    include('crud/user/deleteUser.php');
break;

case "deletenews":
    include('crud/news/deleteNews.php');
break;

case "deletecompanyinformation":
    include('crud/companyinformation/deleteCompanyInformation.php');
break;

case "deleteopeninghour":
    include('crud/openinghour/deleteOpeningHour.php');
break;


// edit
case "editpostalcode":
    include('crud/postalCode/editPostalCode.php');
break;

case "editgenre":
    include('crud/genre/editGenre.php');
break;

case "editroleinproduction":
    include('crud/roleInProduction/editRoleInProduction.php');
break;

case "editproduction":
    include('crud/production/editProduction.php');
break;

case "editvoiceactor":
    include('crud/voiceActor/editVoiceActor.php');
break;

case "editmovie":
    include('crud/movie/editMovie.php');
break;

case "editmoviegenre":
    include('crud/movieGenre/editMovieGenre.php');
break;

case "editmovieproduction":
    include('crud/movieProduction/editMovieProduction.php');
break;

case "editmovievoiceactor":
    include('crud/movieVoiceActor/editMovieVoiceActor.php');
break;

case "editpremiere":
    include('crud/premiere/editPremiere.php');
break;

case "edituser":
    include('crud/user/editUser.php');
break;

case "editnews":
    include('crud/news/editNews.php');
break;

case "editcompanyinformation":
    include('crud/companyinformation/editCompanyInformation.php');
break;

case "editopeninghour":
    include('crud/openinghour/editOpeningHour.php');
break;


// update
case "updatepostalcode":
    include('crud/postalCode/updatePostalCode.php');
break;

case "updategenre":
    include('crud/genre/updateGenre.php');
break;

case "updateroleinproduction":
    include('crud/roleInProduction/updateRoleInProduction.php');
break;

case "updateproduction":
    include('crud/production/updateProduction.php');
break;

case "updatevoiceactor":
    include('crud/voiceActor/updateVoiceActor.php');
break;

case "updatemovie":
    include('crud/movie/updateMovie.php');
break;

case "updatemoviegenre":
    include('crud/movieGenre/updateMovieGenre.php');
break;

case "updatemovieproduction":
    include('crud/movieProduction/updateMovieProduction.php');
break;

case "updatemovievoiceactor":
    include('crud/movieVoiceActor/updateMovieVoiceActor.php');
break;

case "updatepremiere":
    include('crud/premiere/updatePremiere.php');
break;

case "updateuser":
    include('crud/user/updateUser.php');
break;

case "updatenews":
    include('crud/news/updateNews.php');
break;

case "updatecompanyinformation":
    include('crud/companyinformation/updateCompanyInformation.php');
break;

case "updateopeninghour":
    include('crud/openinghour/updateOpeningHour.php');
break;


// detail pages
case "moviedetail":
    include('views/movieDetail.php');
break;

case "newsdetail":
    include('views/newsDetail.php');
break;

case "paymentdetail":
    include('views/paymentDetail.php');
break;

}
?>


<!-- JavaScript -->
<script src="toggle.js"></script>
<script src="dropdown.js"></script>
</body>
</html>