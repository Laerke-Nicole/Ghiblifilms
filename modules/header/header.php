<nav class="pc-nav flex justify-between items-center p-6 pr-12 pl-12">
    <a href="index.php?page=home" class="secondary-color text-3xl uppercase">Ghiblifilms</a>

    <ul class="flex gap-6">
        <li><a href="index.php?page=home" class="secondary-color">Movies</a></li>
        <li><a href="index.php?page=about" class="secondary-color">About</a></li>
        <li><a href="index.php?page=contact" class="secondary-color">Contact</a></li>
        <?php if (!logged_in()): ?>
            <li><a href="index.php?page=login" class="secondary-color">Log in</a></li>
            <li><a href="index.php?page=newuser" class="secondary-color">New user</a></li>
        <?php endif; ?>
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
</nav>