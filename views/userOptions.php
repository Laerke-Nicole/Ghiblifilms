<?php 
require_once("includes/functions.php"); 
?>

<div class="ten-percent">
    <h3>Logged in successfully</h3>

    <br />
    <br />
    
    <!-- btns to buy tickets and go to profile page -->
    <div>
        <h4>Here is what you can do now that you are logged in!</h4>
        
        <a href="index.php?page=home#daily-showings"><button>Buy tickets</button></a>
        <a href="index.php?page=userprofile&UserID=<?php echo $userID; ?>" class="secondary-color"><button>See your profile page</button></a>
    </div>

    <br />
    <br />

    <!-- btns to go to ghiblifilms info -->
    <div>
        <h4>Or check out other stuff you can do!</h4>
        
        <a href="index.php?page=home#movies"><button>Look at movies to book</button></a>
        <a href="index.php?page=home#about-us"><button>Read about Ghiblifilms</button></a>
        <a href="index.php?page=home#news"><button>See our news</button></a>
    </div>
</div>