<?php
echo '<div class="w-half">';
    echo '<div class="box">';
        
        echo '<h3 class="text-xl pb-4">Prefer a direct contact? You can reach us via email or phone:</h3>';
        
            echo '<div class="flex flex-col gap-6">';
            foreach ($getCompanyInformation as $companyInfo) {
                echo '<div>';
                    echo '<h4 class="text-sm">Email us</h4>';
                    echo '<p>' . htmlspecialchars(trim($companyInfo['CompanyEmail'])) . '</p>';
                echo '</div>';
                echo '<div>';
                    echo '<h4 class="text-sm">Call us</h4>';
                    echo '<p>' . htmlspecialchars(trim($companyInfo['CompanyPhoneNumber'])) . '</p>';
                echo '</div>';
            }
            
        echo '</div>';
    echo '</div>';
echo '</div>';