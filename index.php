<?php 
require_once("includes/session.php");
require_once ("includes/dbcon.php"); 
require_once("includes/functions.php");
require_once("includes/connection.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/library.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>

<?php
// check if the user is logged in
if (isset($_SESSION['UserID'])) {
    // get the logged in users id
    $userID = $_SESSION['UserID'];
} else {
    $userID = null;
}
?>


<nav class="flex justify-between items-center p-6">
    <!-- empty div for left side alignment -->
    <div></div>

    <a href="index.php?page=home" class="secondary-color text-3xl caps">Ghiblifilms</a>

    <ul class="flex gap-6">
        
        <!-- only show log in btn if ur not logged in -->
        <?php if (!logged_in()) { ?>
            <li><a href="index.php?page=login" class="secondary-color">Log in</a></li>
        <?php } ?>

        <!-- only show create new user btn if ur not logged in -->
        <?php if (!logged_in()) { ?>
        <li><a href="index.php?page=newuser" class="secondary-color">New user</a></li>
        <?php } ?>

        <?php if ($userID): ?>
            <li><a href="index.php?page=userprofile&UserID=<?php echo $userID; ?>" class="secondary-color">Profile Page</a></li>
        <?php endif; ?>

        <li><a href="index.php?page=admin" class="secondary-color">Admin page</a></li>

        <!-- show log out btn if ur logged in -->
        <?php if (logged_in()) { ?>
            <form action="logout.php" method="post" style="display:inline;">
                <input type="submit" value="Log Out" class="btn">
            </form>
        <?php } ?>
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

case "logout":
    include('logout.php');
break;

case "newuser":
    include('newuser.php');
break;

case "admin":
    include('crud/admin.php');
break;


// controllers
case "controllercreate":
    include('controllers/create.php');
break;

case "controllerdelete":
    include('controllers/delete.php');
break;

case "controllerupdate":
    include('controllers/update.php');
case "controllerupdate":


// oop
case "createoop":
    include('oop/createOOP.php');
break;

case "updateoop":
    include('oop/updateOOP.php');
break;

case "deleteoop":
    include('oop/deleteOOP.php');
break;


// modules
case "categoriesadmin":
    include('modules/admin/categories.php');
break;

case "createandadded":
    include('modules/admin/createAndAdded.php');
break;

case "form":
    include('modules/contactform/form.php');
break;

case "invoice":
    include('modules/invoice/invoice.php');
break;

case "seatreservationform":
    include('modules/seatreservation/form.php');
break;

case "edituserprofile":
    include('modules/userprofile/editUserProfile.php');
break;

case "updateuserprofile":
    include('modules/userprofile/updateUserProfile.php');
break;

case "deleteuserprofile":
    include('modules/userprofile/deleteUserBooking.php');
break;

case "edituserinfo":
    include('modules/userpayment/editUserInfo.php');
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

case "showingsadmin":
    include('crud/adminModules/showingsAdmin.php');
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
case "addmovie":
    include('crud/movie/addMovie.php');
break;

case "addnews":
    include('crud/news/addNews.php');
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

case "deleteshowings":
    include('crud/showings/deleteShowings.php');
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

case "deletereservation":
    include('crud/reservation/deletereservation.php');
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

case "editshowings":
    include('crud/showings/editShowings.php');
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

case "updateshowings":
    include('crud/showings/updateShowings.php');
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


// view/detail pages
case "moviedetail":
    include('views/movieDetail.php');
break;

case "newsdetail":
    include('views/newsDetail.php');
break;

case "paymentdetail":
    include('views/paymentDetail.php');
break;

case "userprofile":
    include('views/userProfile.php');
break;

case "seatreservationdetail":
    include('views/seatReservationDetail.php');
break;

case "invoicedetail":
    include('views/invoiceDetail.php');
break;

case "successfullogindetail":
    include('views/successfulLogInDetail.php');
break;

}
?>


<!-- javascript -->
<script src="/js/showCategory.js" defer></script>
<script src="/js/dropdown.js"></script>
</body>
</html>