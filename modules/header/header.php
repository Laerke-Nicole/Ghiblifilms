<nav class="flex justify-between items-center p-6 pr-12 pl-12">
    <a href="index.php?page=home" class="secondary-color text-3xl caps">Ghiblifilms</a>

    <ul class="flex gap-6">

        <li><a href="index.php?page=home" class="secondary-color">Movies</a></li>
        <li><a href="index.php?page=about" class="secondary-color">About Ghiblifilms</a></li>
        <li><a href="index.php?page=contact" class="secondary-color">Contact us</a></li>
        
        <!-- only show log in btn if ur not logged in  -->
        <?php if (!logged_in()): ?>
            <li><a href="index.php?page=login" class="secondary-color">Log in</a></li>
        <?php endif; ?>

        <!-- only show create new user btn if ur not logged in  -->
        <?php if (!logged_in()): ?>
            <li><a href="index.php?page=newuser" class="secondary-color">New user</a></li>
        <?php endif; ?> 

        <!-- profile page -->
        <?php if ($userID && !is_admin()): ?>
            <li><a href="index.php?page=userprofile&UserID=<?php echo htmlspecialchars(trim($userID)); ?>" class="secondary-color">Profile Page</a></li>
        <?php endif; ?>  

        <!-- admin page -->
        <?php if (is_admin()): ?>
        <li><a href="index.php?page=admin" class="secondary-color">Admin page</a></li>
        <?php endif; ?>   

        <!-- show log out btn if ur logged in  -->
        <?php if (logged_in()): ?>
            <form action="logout.php" method="post" style="display:inline;">
                <input type="submit" value="Log Out">
            </form>
        <?php endif; ?>
    </ul>
</nav>