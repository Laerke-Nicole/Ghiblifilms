<?php
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
require_once ("includes/csrfProtection.php");
?>

<div id="contact-form">
    <!-- input fields -->
    <div>
        <form class="contact-form" action="modules/contactform/email.php" method="post">
            <div class="flex flex-col gap-2">
                <!-- csrf protection -->
                <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
    
                <div>
                    <span>First name</span>
                    <input type="text" id="firstName" name="firstName" placeholder="First name" maxlength="50" class="validate" required="" aria-required="true">
                </div>

                <div>
                    <span>Last name</span>
                    <input type="text" id="lastName" name="lastName" placeholder="Last name" maxlength="50" class="validate" required="" aria-required="true">
                </div>
    
                <div>
                    <span>Email</span>
                    <input type="email" id="email" name="email" placeholder="Email" maxlength="255" class="validate" required="" aria-required="true">
                </div>
    
                <div>
                    <span>Message</span>
                    <textarea id="message" name="message" placeholder="Message" class="validate" required="" aria-required="true"></textarea>
                </div>

                <!-- hidden input for reCAPTCHA token -->
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
    
                <input type="submit" id="submit" name="submit" value="Send message" class="btn-two mt-4">
            </div>

        </form>
    </div>
</div>