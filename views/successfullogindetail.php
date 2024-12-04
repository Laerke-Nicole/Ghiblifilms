<?php 
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
confirm_logged_in(); 
?>


<div class="ten-percent">
    <h3>Logged in successfully</h3>

    <br />
    <br />
    
    <h4>Here is what you can do now</h4>

    <a href="index.php?page=home#daily-showings"><button>Look at daily showings</button></a>

    <a href="index.php?page=home#movies"><button>Look at movies to book</button></a>

    <a href="index.php?page=home#about-us"><button>Read about Ghiblifilms</button></a>

    <a href="index.php?page=home#news"><button>See our news</button></a>
</div>