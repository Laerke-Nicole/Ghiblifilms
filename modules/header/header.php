<nav>
    <div class="container-header flex justify-between items-center">
        <a href="index.php?page=home" class="secondary-color text-3xl uppercase logo primary-font">Ghiblifilms</a>
    
        <ul class="flex">
            <li><a href="index.php?page=movies">Movies</a></li>
            <li><a href="index.php?page=newslist">News</a></li>
            <li><a href="index.php?page=about">About Ghiblifilms</a></li>
            <li><a href="index.php?page=contact">Contact</a></li>
    
                <!-- <li><a href="index.php?page=login" class="secondary-color">Log in</a></li>
                <li><a href="index.php?page=newuser" class="secondary-color">New user</a></li> -->
                <a class="btn dropdown-trigger" href="" data-target="dropdown">
                    <img src="img/icons/user.svg" alt="User icon">
                </a>
    
                <ul id="dropdown1" class="dropdown-content">
                    <!-- if user is not logged in -->
                    <?php if (!logged_in()): ?>
                        <li><a href="index.php?page=login" class="btn-two">Login</a></li>
                        <li><a href="index.php?page=newuser" class="underline">New user</a></li>
                    <?php endif; ?>
    
                    <!-- if user is logged in -->
                    <?php if (logged_in()): ?>
                        <li class="divider"></li>
                        <li class="secondary-color">Welcome back <span class="font-bold"><?php echo htmlspecialchars(trim($userID)); ?></span>!</li>
                        <li><a href="index.php?page=newuser">Your bookings</a></li>
                        <li><a href="index.php?page=newuser">Edit profile</a></li>
                        <li><a href="index.php?page=newuser" class="underline">Log out</a></li>
                    <?php endif; ?>
                </ul>
    
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