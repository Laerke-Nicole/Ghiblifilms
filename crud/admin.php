<?php require_once "includes/dbcon.php";?>

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

<!-- change to a link and id # -->
<h1>Scroll down when clicking a btn</h1>

<br>
<br>
<br>

<!-- buttons to open content of cruds -->
<h5>FK to multiple tables</h5>

<button class="btn" onclick="toggleSection('postalCodeAdmin')">Postal code</button>

<br>
<br>
<br>

<h5>Movie related</h5>

<button class="btn" onclick="toggleSection('genreAdmin')">Genres</button>
<button class="btn" onclick="toggleSection('roleInProductionAdmin')">Role in production</button>
<button class="btn" onclick="toggleSection('productionAdmin')">Production</button>
<button class="btn" onclick="toggleSection('voiceActorAdmin')">voice actors</button>
<button class="btn" onclick="toggleSection('movieAdmin')">Movies</button>
<button class="btn" onclick="toggleSection('movieGenreAdmin')">Movie genres</button>
<button class="btn" onclick="toggleSection('movieProductionAdmin')">Movie production</button>
<button class="btn" onclick="toggleSection('movieVoiceActorAdmin')">Movie voice actors</button>

<br>
<br>
<br>

<h5>Daily premieres</h5>

<button class="btn" onclick="toggleSection('premiereAdmin')">Premieres</button>

<br>
<br>
<br>

<h5>Comapany related</h5>

<button class="btn" onclick="toggleSection('newsAdmin')">News</button>
<button class="btn" onclick="toggleSection('companyInformationAdmin')">Company info</button>
<button class="btn" onclick="toggleSection('openingHourAdmin')">Opening hours</button>

<br>
<br>
<br>

<h5>User related</h5>

<button class="btn" onclick="toggleSection('userAdmin')">Users</button>



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