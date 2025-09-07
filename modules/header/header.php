<nav>
    <div class="container-header flex justify-between items-center">
        <a href="index.php?page=home" class="secondary-color text-3xl uppercase logo primary-font">Ghiblifilms</a>
    
        <ul class="flex">
            <li><a href="index.php?page=movies">Movies</a></li>
            <li><a href="index.php?page=newslist">News</a></li>
            <li><a href="index.php?page=about">About Ghiblifilms</a></li>
            <li><a href="index.php?page=contact">Contact</a></li>
            
            <?php require_once 'modules/blocks/dropdown.php' ?>
    
            <?php if ($userID && !is_admin()): ?>
                <li><a href="index.php?page=userprofile&UserID=<?php echo htmlspecialchars(trim($userID)); ?>" class="secondary-color">Profile</a></li>
            <?php endif; ?>  
            <?php if (is_admin()): ?>
                <li><a href="index.php?page=admin" class="secondary-color">Admin</a></li>
            <?php endif; ?>   
            <?php if (logged_in()): ?>
                <form action="logout.php" method="post" class="inline">
                    <input type="submit" value="Log Out" class="secondary-color cursor-pointer">
                </form>
            <?php endif; ?>
        </ul>
    </div>
</nav>