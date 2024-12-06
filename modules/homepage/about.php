<?php
echo '<section id="about-us">';
    echo '<div class="about-ghiblifilms flex pt-20 pb-20 justify-around">';
        foreach ($getAboutCompany as $about) {
            echo '<div class="flex-1 max-w-xs">';
                echo '<h2 class="primary-color text-6xl">About<br>' . htmlspecialchars(trim($about['NameOfCompany'])) . '</h2>';
            echo '</div>';

            echo '<div class="flex-1 max-w-lg">';
                echo '<p class="primary-color primary-font text-lg">' . htmlspecialchars(trim($about['CompanyDescription'])) . '</p>';
            echo '</div>';
        }

    echo '</div>';  
echo '</section>';