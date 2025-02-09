<?php require_once("controllers/companyController.php"); ?>

<section class="s-bg">
    <div class="grid-1-2">
        <div class="contact-left-img"></div>

        <div class="contact">
            <div class="pb-12">
                <h1 class="pb-2">Contact us</h1>
                <?php foreach ($companyMailPhone as $companyInfo): ?>
                    <p><?php echo htmlspecialchars(trim($companyInfo['CompanyEmail'])); ?></p>
                    <p>+45 <?php echo htmlspecialchars(trim($companyInfo['CompanyPhoneNumber'])); ?></p>
                <?php endforeach; ?>
            </div>

            <div>
                <!-- contact form  -->
                <?php include ("modules/contactform/form.php"); ?>
            </div>

        </div>
    </div>
</section>