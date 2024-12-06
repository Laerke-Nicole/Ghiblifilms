<?php 
echo '<section class="ten-percent pt-24 pb-24">';
    echo '<h1 class="text-3xl weight-400 pb-12">Contact us with any questions</h1>';

    echo '<div class="flex gap-4">';
        // contact form 
        include ("modules/contactform/form.php");
        
        // contact info 
        include ("modules/homepage/contactInfo.php");

    echo '</div>';
echo '</section>';