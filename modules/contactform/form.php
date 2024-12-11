<?php
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
require_once ("includes/csrfProtection.php");
?>

<div class="w-half" id="contact-form">
    <div>
        <h2 class="text-xl pb-4">Fill out the form below and we will get back to you as soon as possible.</h2>
    </div>

    <!-- input fields -->
    <div class="w-half">
        <form class="contact-form" action="modules/contactform/email.php" method="post">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">

            <div>
                <input type="text" id="firstName" name="firstName" placeholder="First name" class="validate" required="" aria-required="true">
            </div>

            <div>
                <input type="text" id="lastName" name="lastName" placeholder="Last name" class="validate" required="" aria-required="true">
            </div>

            <div>
                <input type="email" id="email" name="email" placeholder="Email" class="validate" required="" aria-required="true">
            </div>

            <div>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Phone number" class="validate" required="" aria-required="true">
            </div>

            <div>
                <input type="text" id="subject" name="subject" placeholder="Subject" class="validate" required="" aria-required="true">
            </div>

            <div>
                <textarea id="message" name="message" placeholder="Message" class="validate" required="" aria-required="true"></textarea>
            </div>

            <!-- hidden input for reCAPTCHA token -->
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

            <input type="submit" id="submit" name="submit" value="Send" class="btn">

        </form>
    </div>
</div>