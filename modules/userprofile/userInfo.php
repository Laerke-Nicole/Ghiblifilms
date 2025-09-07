<div class="container pt-10">
    <h2>Your information</h2>
    
    <!-- show all user info -->
    <?php if ($userProfile = $getUserProfileView[0]): ?>
        <div>
            <p><strong>Username: </strong><?php echo htmlspecialchars(trim($userProfile['Username'])); ?></p>
            <p><strong>Name: </strong><?php echo htmlspecialchars(trim($userProfile['FirstName'])) . " "  . htmlspecialchars(trim($userProfile['LastName'])); ?></p>
            <p><strong>Email: </strong><?php echo htmlspecialchars(trim($userProfile['Email'])); ?></p>
            <p><strong>Phone number: </strong><?php echo htmlspecialchars(trim($userProfile['PhoneNumber'])); ?></p>
            <p><strong>Address: </strong><?php echo htmlspecialchars(trim($userProfile['StreetName'])) . " " . htmlspecialchars(trim($userProfile['StreetNumber'])); ?></p>
            <p><strong>Country: </strong><?php echo htmlspecialchars(trim($userProfile['Country'])); ?></p>
            <p><strong>Postal code: </strong><?php echo htmlspecialchars(trim($userProfile['PostalCode'])); ?></p>
            <p class="pb-4"><strong>City: </strong><?php echo htmlspecialchars(trim($userProfile['City'])); ?></p>
                
            <a href="index.php?page=edituserprofile&ID=<?php echo $userProfile['UserID']; ?>" class="btn-two">Edit your info</a>
        </div>
    <?php else: ?>
        <p>No user found.</p>
    <?php endif; ?>
</div>