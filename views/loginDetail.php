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

<div class="container pt-10 flex justify-center">
    <div class="form-wrapper">
        <h2>Log in</h2>
        
        <form action="" method="post" class="login-form">
            <!-- CSRF protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            
            <!-- hidden input for reCAPTCHA token -->
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

            <div class="form-group">
                <span>Username</span>
                <input type="text" name="User" maxlength="50" placeholder="Username" class="input-field" required />
            </div>
            
            <div class="form-group">
                <span>Password</span>
                <input type="password" name="Pass" maxlength="255" placeholder="Password" class="input-field" required />
            </div>
            
            <div class="form-actions">
                <input type="submit" name="submit" value="Login" class="btn-two" />
            </div>

            <p class="secondary-color text-xs">Got no user? <a href="index.php?page=newuser" class="secondary-color text-sm create-user-link">Create a new user here</a></p> 
        </form>
    </div>
</div>


</div>
</body>
</html>