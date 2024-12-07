<?php
echo '<div class="row ten-percent">';
    echo '<h2>Your information</h2>';
    echo '<br>';
    
    if ($userProfile = $getUserProfileView[0]) {
        echo "<div>";
            echo '<p><strong>Username: </strong>' . htmlspecialchars(trim($userProfile['Username'])) . '</p>';
            echo '<p><strong>Name: </strong>' . htmlspecialchars(trim($userProfile['FirstName'])) . " "  . htmlspecialchars(trim($userProfile['LastName'])) .  '</p>';
            echo '<p><strong>Email: </strong>' . htmlspecialchars(trim($userProfile['Email'])) . '</p>';
            echo '<p><strong>Phone number: </strong>' . htmlspecialchars(trim($userProfile['PhoneNumber'])) . '</p>';
            echo '<p><strong>Address: </strong>' . htmlspecialchars(trim($userProfile['StreetName'])) . " " . htmlspecialchars(trim($userProfile['StreetNumber'])) . '</p>';
            echo '<p><strong>Country: </strong>' . htmlspecialchars(trim($userProfile['Country'])) . '</p>';
            echo '<p><strong>Postal code: </strong>' . htmlspecialchars(trim($userProfile['PostalCode'])) . '</p>';
            echo '<p><strong>City: </strong>' . htmlspecialchars(trim($userProfile['City'])) . '</p>';
                
            echo "<br/>";
            echo '<a href="index.php?page=edituserprofile&ID='.$userProfile['UserID'].'" class="btn">Edit your info</a></div>';
        echo "</div>";
    } else {
        echo "<p>No user found.</p>";
    }
echo '</div>';