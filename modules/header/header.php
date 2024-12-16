<nav class="flex justify-between items-center p-6">
    <!-- empty div for left side alignment  -->
    <div></div>

    <a href="index.php?page=home" class="secondary-color text-3xl caps">Ghiblifilms</a>

    <ul class="flex gap-6">
        
        <!-- only show log in btn if ur not logged in  -->
        <?php if (!logged_in()): ?>
            <li><a href="index.php?page=login" class="secondary-color">Log in</a></li>
        <?php endif; ?>

        <!-- only show create new user btn if ur not logged in  -->
        <?php if (!logged_in()): ?>
            <li><a href="index.php?page=newuser" class="secondary-color">New user</a></li>
        <?php endif; ?> 

        <?php if ($userID && !is_admin()): ?>
            <li><a href="index.php?page=userprofile&UserID=' . htmlspecialchars(trim($userID)) . '" class="secondary-color">Profile Page</a></li>
        <?php endif; ?>     

        <?php if (is_admin()): ?>
        <li><a href="index.php?page=admin" class="secondary-color">Admin page</a></li>
        <?php endif; ?>   

        <!-- show log out btn if ur logged in  -->
        <?php if (logged_in()): ?>
            <form action="logout.php" method="post" style="display:inline;">
                <input type="submit" value="Log Out" class="btn">
            </form>
        <?php endif; ?>
    </ul>
</nav>