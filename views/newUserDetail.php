<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New user</title>
    <link rel="stylesheet" href="../style/style.css">
    <!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Le5im4qAAAAABvcp4E5XaeQ54PjcD-9ql3pq5nF"></script>
    <script src="js/recaptcha.js" defer></script>
</head>

<div class="six-percent pt-6 pb-20 flex flex-col justify-center align-center">

    <div>
        <h2 class="pb-4">Create New User</h2>
        
        <form action="" method="post" class="flex flex-col newuser-form">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            
            <!-- hidden input for reCAPTCHA token -->
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
            
            <div class="row pb-4 gap-4">
                <div class="input-field col s6">
                    <input type="text" name="Username" maxlength="50" value="" placeholder="Username" class="validate" required="" aria-required="true" />
                </div>

                <div class="input-field col s6">
                <input type="password" name="Pass" maxlength="255" value="" placeholder="Password" class="validate" required="" aria-required="true" />
                </div>
            </div>

            <div class="row pb-4 gap-4">
                <div class="input-field col s6">
                    <input type="text" name="FirstName" maxlength="50" value="" placeholder="First name" class="validate" required="" aria-required="true" />
                </div>

                <div class="input-field col s6">
                    <input type="text" name="LastName" maxlength="50" value="" placeholder="Last name" class="validate" required="" aria-required="true" />
                </div>
            </div>

            <div class="row pb-4 gap-4">
                <div class="input-field col s6">
                    <input type="text" name="Email" maxlength="255" value="" placeholder="Email" class="validate" required="" aria-required="true" />
                </div>

                <div class="input-field col s6">
                    <input type="text" name="PhoneNumber" maxlength="20" value="" placeholder="Phone number" class="validate" required="" aria-required="true" />
                </div>
            </div>

            <div class="row pb-4 gap-4">
                <div class="input-field col s6">
                    <input type="text" name="StreetName" maxlength="255" value="" placeholder="Street name" class="validate" required="" aria-required="true" />
                </div>

                <div class="input-field col s6">
                    <input type="number" name="StreetNumber" maxlength="10" value="" placeholder="Street number" class="validate" required="" aria-required="true" />
                </div>
            </div>


            <div class="row pb-4 gap-4">
                <div class="input-field col s6">
                    <input type="text" name="PostalCode" maxlength="10" value="" placeholder="Postal code" class="validate" required="" aria-required="true" />
                </div>

                <div class="input-field col s6">
                    <input type="text" name="Country" maxlength="150" value="" placeholder="Country" class="validate" required="" aria-required="true" />
                </div>
            </div>
        
            <div class="cursor pb-2">
                <input type="submit" name="submit" value="Create user" class="btn-two" />
            </div>
        
            <div>
                <p class="secondary-color text-sm">Aldready got a user? <a href="index.php?page=login" class="secondary-color text-sm create-user-link">Log in here</a></p>
            </div>
        </form>
    </div>
</div>

</body>
</html>