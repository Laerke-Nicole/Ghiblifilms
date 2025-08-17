<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Le5im4qAAAAABvcp4E5XaeQ54PjcD-9ql3pq5nF"></script>
    <script src="js/recaptcha.js" defer></script>
</head>

<div class="six-percent pt-6 pb-20 flex flex-col justify-center align-center">
    <div>
        <h2 class="pb-4">Log in</h2>
        
        <form action="" method="post" class="flex flex-col login-form">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            
            <!-- hidden input for reCAPTCHA token -->
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
        
            <div class="pb-4">
                <input type="text" name="User" maxlength="50" value="" placeholder="Username" class="validate" required="" aria-required="true" />
            </div>
            
            <div class="pb-6">
                <input type="password" name="Pass" maxlength="255" value="" placeholder="Password" class="validate" required="" aria-required="true" />
            </div>
        
            <div class="cursor pb-2">
                <input type="submit" name="submit" value="Login" class="btn-two" />
            </div>
        
            <div>
                <p class="secondary-color text-sm">Got no user? <a href="index.php?page=newuser" class="secondary-color text-sm create-user-link">Create a new user here</a></p> 
            </div>
        </form>
    </div>

</div>
</body>
</html>