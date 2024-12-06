<?php  
echo '<section>';
    // display company address info 
    echo '<div class="ten-percent pb-24">';
          
        foreach ($getCompanyAddressView as $companyAddress) {
            echo '<h5>Find '. htmlspecialchars(trim($companyAddress['NameOfCompany'])) . ' address:</h5>';
            echo '<div>';
                echo '<p>'. htmlspecialchars(trim($companyAddress['StreetName'])) . '</p>';
                echo '<p>'. htmlspecialchars(trim($companyAddress['StreetNumber'])) . '</p>';
            echo '</div>';

            echo '<div>';
                echo '<p>'. htmlspecialchars(trim($companyAddress['PostalCode'])) . '</p>';
                echo '<p>'. htmlspecialchars(trim($companyAddress['City'])) . '</p>';
                echo '<p>'. htmlspecialchars(trim($companyAddress['Country'])) . '</p>';
                echo '<p>'. htmlspecialchars(trim($companyAddress['City'])) . '</p>';
            echo '</div>';
        }

    echo '</div>';
echo '</section>';