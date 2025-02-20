<?php
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
require_once ("includes/csrfProtection.php");
?>

<div id="contact-form">
    <!-- input fields -->
    <div>
        <form class="contact-form" action="modules/contactform/email.php" method="post">
            <div class="flex flex-col gap-4">
                <!-- csrf protection -->
                <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
    
                <div class="flex gap-x-4">
                    <input type="text" id="firstName" name="firstName" placeholder="First name" maxlength="50" class="validate" required="" aria-required="true">
                    <input type="text" id="lastName" name="lastName" placeholder="Last name" maxlength="50" class="validate" required="" aria-required="true">
                </div>
    
                <div>
                    <input type="email" id="email" name="email" placeholder="Email" maxlength="255" class="validate" required="" aria-required="true">
                </div>
    
                <div>
                    <textarea id="message" name="message" placeholder="Message" class="validate" required="" aria-required="true"></textarea>
                </div>

                <!-- hidden input for reCAPTCHA token -->
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
    
                <input type="submit" id="submit" name="submit" value="Send message" class="btn-two mt-2">
            </div>

        </form>
    </div>
</div>