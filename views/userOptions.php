<?php 
require_once("includes/functions.php"); 
?>

<div class="container pt-10">
    <h2>Logged in successfully!</h2>

    <br />
    
    <!-- btns to buy tickets and go to profile page -->
    <div>
        <h4>Here is what you can do now that you are logged in!</h4>
        
        <div class="flex gap-2">
            <a href="index.php?page=home#daily-showings"><button class="btn-two">Buy tickets</button></a>
            <a href="index.php?page=userprofile&UserID=<?php echo $userID; ?>" class="secondary-color"><button class="btn-two">See your profile page</button></a>
        </div>
    </div>

    <br />
    <br />

    <!-- btns to go to ghiblifilms info -->
    <div>
        <h5>Or check out other stuff you can do!</h5>
        
        <div class="flex gap-2">
            <a href="index.php?page=movies"><button class="btn-one">Look at movies to book</button></a>
            <a href="index.php?page=newslist"><button class="btn-one">See our news</button></a>
            <a href="index.php?page=about"><button class="btn-one">Read about Ghiblifilms</button></a>
        </div>
    </div>
</div>