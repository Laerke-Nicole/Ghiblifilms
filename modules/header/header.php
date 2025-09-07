<nav>
    <div class="container-header flex justify-between items-center">
        <a href="index.php?page=home" class="secondary-color text-3xl uppercase logo primary-font">Ghiblifilms</a>
    
        <ul class="flex nav-desktop">
            <li><a href="index.php?page=movies">Movies</a></li>
            <li><a href="index.php?page=newslist">News</a></li>
            <li><a href="index.php?page=about">About Ghiblifilms</a></li>
            <li><a href="index.php?page=contact">Contact</a></li>
            
            <?php include 'modules/blocks/dropdown.php' ?>
    
            <!-- <?php if ($userID && !is_admin()): ?>
                <li><a href="index.php?page=userprofile&UserID=<?php echo htmlspecialchars(trim($userID)); ?>" class="secondary-color">Profile</a></li>
            <?php endif; ?>   -->
            
        </ul>
    </div>
</nav>


