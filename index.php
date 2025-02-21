<?php 
require_once("includes/session.php");
require_once ("includes/dbcon.php"); 
require_once("includes/functions.php");
require_once("includes/connection.php");
require_once ("includes/csrfProtection.php");

// check if the user is logged in
if (isset($_SESSION['UserID'])) {
    // get the logged in users id
    $userID = $_SESSION['UserID'];
} else {
    $userID = null;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/library.css">
    <link rel="stylesheet" href="https://use.typekit.net/arj0iay.css">
    <!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Le5im4qAAAAABvcp4E5XaeQ54PjcD-9ql3pq5nF"></script>
    <script src="js/recaptcha.js" defer></script>
    
</head>

<body>
<!-- header to include on all pages -->
<?php include("modules/header/header.php"); ?>


<?php
if (isset($_GET['page'])){
	$page = $_GET['page'];
	} else{
		$page = "index";}

switch($page) {

default:
    include('home.php');
break;

case "about":
    include('views/aboutDetail.php');
break;

case "contact":
    include('views/contactDetail.php');
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
break;


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

case "resizer":
    include('oop/resizerOOP.php');
break;

case "getidoop":
    include('oop/getIDOOP.php');
break;


// modules
case "hero":
    include('modules/homepage/hero.php');
break;

case "collage":
    include('modules/homepage/collage.php');
break;

case "highlightmovie":
    include('modules/homepage/highlightMovie.php');
break;

case "homenews":
    include('modules/homepage/news.php');
break;

case "homemovies":
    include('modules/homepage/movies.php');
break;

case "homeabout":
    include('modules/homepage/about.php');
break;

case "homecontactformandcontactinfo":
    include('modules/homepage/contactFormAndContactInfo.php');
break;

case "homecontactinfo":
    include('modules/homepage/contactinfo.php');
break;

case "homeopeninghours":
    include('modules/homepage/openingHours.php');
break;

case "homeauditorium":
    include('modules/homepage/auditorium.php');
break;

case "homeaddress":
    include('modules/homepage/address.php');
break;

case "moviedetails":
    include('modules/movie/movieDetails.php');
break;

case "movieshowings":
    include('modules/movie/showings.php');
break;

case "movietrailer":
    include('modules/movie/trailer.php');
break;

case "categoriesadmin":
    include('modules/admin/categories.php');
break;

case "createandadded":
    include('modules/admin/createAndAdded.php');
break;

case "form":
    include('modules/contactform/form.php');
break;

case "email":
    include('modules/contactform/email.php');
break;

case "invoice":
    include('modules/invoice/invoice.php');
break;

case "seatreservationform":
    include('modules/seatreservation/form.php');
break;

case "seatreservationcontent":
    include('modules/seatreservation/seatReservationContent.php');
break;

case "userinfo":
    include('modules/userprofile/userInfo.php');
break;

case "userbookings":
    include('modules/userprofile/userBookings.php');
break;

case "edituserprofile":
    include('modules/userprofile/editUserProfile.php');
break;

case "edituserinfo":
    include('modules/userpayment/editUserInfo.php');
break;

case "paymentcontent":
    include('modules/payment/paymentContent.php');
break;

case "newsmodule":
    include('modules/news/news.php');
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

// edit
case "editgenre":
    include('crud/editCrud/editGenre.php');
break;

case "editroleinproduction":
    include('crud/editCrud/editRoleInProduction.php');
break;

case "editproduction":
    include('crud/editCrud/editProduction.php');
break;

case "editvoiceactor":
    include('crud/editCrud/editVoiceActor.php');
break;

case "editmovie":
    include('crud/movie/editMovie.php');
break;

case "editmoviegenre":
    include('crud/editCrud/editMovieGenre.php');
break;

case "editmovieproduction":
    include('crud/editCrud/editMovieProduction.php');
break;

case "editmovievoiceactor":
    include('crud/editCrud/editMovieVoiceActor.php');
break;

case "editshowings":
    include('crud/editCrud/editShowings.php');
break;

case "editnews":
    include('crud/news/editNews.php');
break;

case "editcompanyinformation":
    include('crud/editCrud/editCompanyInformation.php');
break;

case "editopeninghour":
    include('crud/editCrud/editOpeningHour.php');
break;


// update
case "updatemovie":
    include('crud/movie/updateMovie.php');
break;

case "updatenews":
    include('crud/news/updateNews.php');
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

case "useroptions":
    include('views/userOptions.php');
break;

case "newuserdetail":
    include('views/newUserDetail.php');
break;

case "logindetail":
    include('views/loginDetail.php');
break;

}
?>


<!-- footer to include on all pages -->
<?php include("modules/footer/footer.php"); ?>



<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
<!-- javascript -->
<script src="/js/showCategory.js" defer></script>

<script src="/js/dropdown.js"></script>

<!-- js with swiper -->
<script src="./js/slider.js" defer></script>

<!-- toggle -->
<script src="./js/toggle.js" defer></script>
</body>
</html>