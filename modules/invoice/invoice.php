<?php
require_once("includes/dbcon.php");
require_once("includes/functions.php");
require_once("includes/session.php");
confirm_logged_in();
?>

<!-- btns to userprofile or home after payment success -->
<div class="ten-percent pt-6 pb-20">
    <h1>Payment succeeded</h1>
    <p>You can now check your booking out on your profile page or go to the homepage to see more movies.</p>
    <br/>

    <div class="flex gap-2">
        <button class="btn-two" onclick="window.location.href='index.php?page=userprofile&UserID=<?php echo $userID; ?>'">Go to your profile</button>
        <button class="btn-two" onclick="window.location.href='index.php?page=home'">Go to home page</button>
    </div>
</div>