<?php
echo '<nav class="flex justify-between items-center p-6">';
    // empty div for left side alignment 
    echo '<div></div>';

    echo '<a href="index.php?page=home" class="secondary-color text-3xl caps">Ghiblifilms</a>';

    echo '<ul class="flex gap-6">';
        
        // only show log in btn if ur not logged in 
        if (!logged_in()) { 
            echo '<li><a href="index.php?page=login" class="secondary-color">Log in</a></li>';
        } 

        // only show create new user btn if ur not logged in 
        if (!logged_in()) { 
        echo '<li><a href="index.php?page=newuser" class="secondary-color">New user</a></li>';
        } 

        if ($userID): 
            echo '<li><a href="index.php?page=userprofile&UserID=' . htmlspecialchars(trim($userID)) . '" class="secondary-color">Profile Page</a></li>';
        endif;        

        
        echo '<li><a href="index.php?page=admin" class="secondary-color">Admin page</a></li>';

        // show log out btn if ur logged in 
        if (logged_in()) { 
            echo '<form action="logout.php" method="post" style="display:inline;">';
                echo '<input type="submit" value="Log Out" class="btn">';
            echo '</form>';
        } 
    echo '</ul>';
echo '</nav>';