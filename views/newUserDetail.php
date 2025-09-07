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

<div class="container pt-10 flex justify-center">
    <div class="form-wrapper">
        <h2>Create New User</h2>
        <form action="" method="post" class="newuser-form">
            <!-- CSRF protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
            <!-- hidden input for reCAPTCHA token -->
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

            <!-- Username & Password -->
            <div class="form-row">
                <div class="form-group">
                    <span>Username</span>
                    <input type="text" name="Username" maxlength="50" placeholder="Username" class="input-field" required />
                </div>
                <div class="form-group">
                    <span>Password</span>
                    <input type="password" name="Pass" maxlength="255" placeholder="Password" class="input-field" required />
                </div>
            </div>

            <!-- First name & Last name -->
            <div class="form-row">
                <div class="form-group">
                    <span>First name</span>
                    <input type="text" name="FirstName" maxlength="50" placeholder="First name" class="input-field" required />
                </div>
                <div class="form-group">
                    <span>Last name</span>
                    <input type="text" name="LastName" maxlength="50" placeholder="Last name" class="input-field" required />
                </div>
            </div>

            <!-- Email & Phone -->
            <div class="form-row">
                <div class="form-group">
                    <span>Email</span>
                    <input type="email" name="Email" maxlength="255" placeholder="Email" class="input-field" required />
                </div>
                <div class="form-group">
                    <span>Phone number</span>
                    <input type="text" name="PhoneNumber" maxlength="20" placeholder="Phone number" class="input-field" required />
                </div>
            </div>

            <!-- Address fields -->
            <div class="form-row">
                <div class="form-group">
                    <span>Street name</span>
                    <input type="text" name="StreetName" maxlength="255" placeholder="Street name" class="input-field" required />
                </div>
                <div class="form-group">
                    <span>Street number</span>
                    <input type="number" name="StreetNumber" maxlength="10" placeholder="Street number" class="input-field" required />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <span>Postal code</span>
                    <input type="text" name="PostalCode" maxlength="10" placeholder="Postal code" class="input-field" required />
                </div>
                <div class="form-group">
                    <span>Country</span>
                    <input type="text" name="Country" maxlength="150" placeholder="Country" class="input-field" required />
                </div>
            </div>

            <div class="form-actions">
                <input type="submit" name="submit" value="Create user" class="btn-two" />
            </div>

            <p class="secondary-color text-xs">Already got a user? <a href="index.php?page=login" class="secondary-color text-sm create-user-link">Log in here</a></p>
        </form>
    </div>
</div>


</body>
</html>