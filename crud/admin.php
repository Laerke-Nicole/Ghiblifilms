<?php require_once ("includes/dbcon.php");?>
<?php require_once("includes/session.php"); ?>
<?php //confirm_logged_in(); ?>

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

<body>

<br>


<!-- buttons to open content of cruds -->
<h5>FK to multiple tables</h5>

<a href="#postalCodeAdmin">
    <button class="btn" onclick="toggleSection('postalCodeAdmin')">Postal code</button>
</a>


<br>
<br>
<br>


<h5>Movie related</h5>

<a href="#genreAdmin">
    <button class="btn" onclick="toggleSection('genreAdmin')">Genres</button>
</a>

<a href="#roleInProductionAdmin">
    <button class="btn" onclick="toggleSection('roleInProductionAdmin')">Role in production</button>
</a>

<a href="#productionAdmin">
    <button class="btn" onclick="toggleSection('productionAdmin')">Production</button>
</a>

<a href="#voiceActorAdmin">
    <button class="btn" onclick="toggleSection('voiceActorAdmin')">voice actors</button>
</a>

<a href="#movieAdmin">
    <button class="btn" onclick="toggleSection('movieAdmin')">Movies</button>
</a>

<a href="#movieGenreAdmin">
    <button class="btn" onclick="toggleSection('movieGenreAdmin')">Movie genres</button>
</a>

<a href="#movieProductionAdmin">
    <button class="btn" onclick="toggleSection('movieProductionAdmin')">Movie production</button>
</a>

<a href="#movieVoiceActorAdmin">
    <button class="btn" onclick="toggleSection('movieVoiceActorAdmin')">Movie voice actors</button>
</a>


<br>
<br>
<br>


<h5>Daily premieres</h5>

<a href="#premiereAdmin">
    <button class="btn" onclick="toggleSection('premiereAdmin')">Premieres</button>
</a>


<br>
<br>
<br>


<h5>Company related</h5>

<a href="#newsAdmin">
    <button class="btn" onclick="toggleSection('newsAdmin')">News</button>
</a>

<a href="#companyInformationAdmin">
    <button class="btn" onclick="toggleSection('companyInformationAdmin')">Company info</button>
</a>

<a href="#openingHourAdmin">
    <button class="btn" onclick="toggleSection('openingHourAdmin')">Opening hours</button>
</a>


<br>
<br>
<br>


<h5>User related</h5>

<a href="#userAdmin">
    <button class="btn" onclick="toggleSection('userAdmin')">Users</button>
</a>


<!-- Postal Code Section -->
<div id="postalCodeAdmin" style="display: none;">
    <?php require 'adminModules/postalCodeAdmin.php'; ?>
</div>

<!-- Genre Section -->
<div id="genreAdmin" style="display: none;">
    <?php require 'adminModules/genreAdmin.php'; ?>
</div>

<!-- Role In Production Section -->
<div id="roleInProductionAdmin" style="display: none;">
    <?php require 'adminModules/roleInProductionAdmin.php'; ?>
</div>

<!-- Production Section -->
<div id="productionAdmin" style="display: none;">
    <?php require 'adminModules/productionAdmin.php'; ?>
</div>

<!-- Voice Actor Section -->
<div id="voiceActorAdmin" style="display: none;">
    <?php require 'adminModules/voiceActorAdmin.php'; ?>
</div>

<!-- Movie Admin Section -->
<div id="movieAdmin" style="display: none;">
    <?php require 'adminModules/movieAdmin.php'; ?>
</div>

<!-- Movie Genre Admin Section -->
<div id="movieGenreAdmin" style="display: none;">
    <?php require 'adminModules/movieGenreAdmin.php'; ?>
</div>

<!-- Movie Production Admin Section -->
<div id="movieProductionAdmin" style="display: none;">
    <?php require 'adminModules/movieProductionAdmin.php'; ?>
</div>

<!-- Movie Voice Actor Admin Section -->
<div id="movieVoiceActorAdmin" style="display: none;">
    <?php require 'adminModules/movieVoiceActorAdmin.php'; ?>
</div>

<!-- User Admin Section -->
<div id="premiereAdmin" style="display: none;">
    <?php require 'adminModules/premiereAdmin.php'; ?>
</div>

<!-- User Admin Section -->
<div id="userAdmin" style="display: none;">
    <?php require 'adminModules/userAdmin.php'; ?>
</div>

<!-- News Admin Section -->
<div id="newsAdmin" style="display: none;">
    <?php require 'adminModules/newsAdmin.php'; ?>
</div>

<!-- Company info Admin Section -->
<div id="companyInformationAdmin" style="display: none;">
    <?php require 'adminModules/companyInformationAdmin.php'; ?>
</div>

<!-- Opening hour Admin Section -->
<div id="openingHourAdmin" style="display: none;">
    <?php require 'adminModules/openingHourAdmin.php'; ?>
</div>



<br>
<br>
<br>


</body>
</html>