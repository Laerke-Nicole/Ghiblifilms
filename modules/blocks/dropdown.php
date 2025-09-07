<el-dropdown class="inline-block">
  <button class="inline-flex w-full justify-center">
    <img src="img/icons/user.svg" alt="User icon">
  </button>

  <el-menu anchor="bottom end" popover class="w-56 origin-top-right rounded-md dark-bg outline-1 -outline-offset-1 outline-white/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
    <div class="py-1">
        <!-- if user is not logged in -->
        <?php if (!logged_in()): ?>
            <a href="index.php?page=login" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Login</a>
            <a href="index.php?page=newuser" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">New user</a>
        <?php endif; ?>

        <!-- if user is logged in -->
        <?php if (logged_in()): ?>
            <div class="divider"></div>
            <p class="secondary-color">Welcome back <span class="font-bold"><?php echo htmlspecialchars(trim($userID)); ?></span>!</p>
            <a href="index.php?page=newuser" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Your bookings</a>
            <a href="index.php?page=newuser" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Edit profile</a>
            <a href="index.php?page=newuser" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Your bookings</a>
            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Sign out</button>
        <?php endif; ?>
    </div>
  </el-menu>
</el-dropdown>