<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New user</title>
    <!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Le5im4qAAAAABvcp4E5XaeQ54PjcD-9ql3pq5nF"></script>
    <script src="js/recaptcha.js" defer></script>
</head>

<h2>Create New User</h2>

<form action="" method="post" class="flex flex-col">
    <!-- csrf protection -->
    <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
    
    <!-- hidden input for reCAPTCHA token -->
    <!-- <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response"> -->
    
    <div class="pb-4">
        <p>Username:</p>
        <input type="text" name="Username" maxlength="50" value="" class="validate" required="" aria-required="true" />
    </div>
    
    <div class="pb-4">
        <p>Password:</p>
        <input type="password" name="Pass" maxlength="255" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>First name:</p>
        <input type="text" name="FirstName" maxlength="50" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Last name:</p>
        <input type="text" name="LastName" maxlength="50" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Email:</p>
        <input type="text" name="Email" maxlength="255" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Phone number:</p>
        <input type="text" name="PhoneNumber" maxlength="20" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Street name:</p>
        <input type="text" name="StreetName" maxlength="255" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Street number:</p>
        <input type="number" name="StreetNumber" maxlength="10" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Postal code:</p>
        <input type="text" name="PostalCode" maxlength="10" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Country:</p>
        <input type="text" name="Country" maxlength="150" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="cursor">
        <input type="submit" name="submit" value="Create" class="btn" />
    </div>

    <input class="g-recaptcha" 
        data-sitekey="6LcYqN8oAAAAAMR4uWAINgyvso2t7FITrhBawMTO" 
        data-callback='onSubmit' 
        data-action='submit'
        type="submit" name="submit" value="Create" />

    <div>
        <a href="index.php?page=login" class="secondary-color">Aldready got a user? Log in here</a>
    </div>
</form>

</body>
</html>