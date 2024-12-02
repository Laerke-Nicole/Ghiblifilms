<?php
require_once("includes/dbcon.php");
require_once("includes/functions.php");
require_once("includes/session.php");
?>

<div class="ten-percent">
    <h1>Payment succeeded</h1>
    <p>You can now check your booking out on your profile page or go to the homepage to see more movies.</p>
    <br/>
    
    <a href="index.php?page=userprofile&UserID=<?php echo $userID; ?>" class="secondary-color">
    <button class="btn" onclick="window.location.href='index.php?page=userprofile&UserID=<?php echo $userID; ?>'">Go to your profile</button>
    <button class="btn" onclick="window.location.href='index.php?page=default'">Go to home page</button>
</div>