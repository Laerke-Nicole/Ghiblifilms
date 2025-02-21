<?php require_once("controllers/companyController.php"); ?>

<footer>
    <div class="flex justify-evenly">
        <!-- company info -->
        <div>
            <h3 class="pb-4 text-2xl uppercase etna white-headline">Ghiblifilms</h3>
            <?php foreach ($everythingCompany as $companyInfo): ?>
            <div class="flex flex-col gap-6">
                <div class="flex flex-col gap-2">
                    <p class="white-text text-sm">+45 <?php echo htmlspecialchars(trim($companyInfo['CompanyPhoneNumber'])); ?></p>
                    <p class="white-text text-sm"><?php echo htmlspecialchars(trim($companyInfo['CompanyEmail'])); ?></p>
                </div>
                <?php endforeach; ?>

                <?php foreach ($getCompanyAddressView as $companyAddress): ?>
                    <div>
                        <p class="white-text text-sm"><?php echo htmlspecialchars(trim($companyAddress['StreetName'])); ?><?php echo htmlspecialchars(trim($companyAddress['StreetNumber'])); ?></p>
                        <p class="white-text text-sm"><?php echo htmlspecialchars(trim($companyAddress['PostalCode'])); ?> <?php echo htmlspecialchars(trim($companyAddress['City'])); ?></p>
                        <p class="white-text text-sm"><?php echo htmlspecialchars(trim($companyAddress['Country'])); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- about us links -->
        <div>
            <h4 class="pb-2 white-headline">About Us</h4>
            <div class="flex flex-col gap-2">
                <a href="index.php?page=home" class="footer-link"><p>Movies</p></a>
                <a href="index.php?page=about" class="footer-link"><p>About Ghiblifilms</p></a>
                <a href="index.php?page=contact" class="footer-link"><p>Contact Us</p></a>
                <p class="white-text text-sm">Job at Ghiblifilms</p>
                <p class="white-text text-sm">Membership</p>
                <p class="white-text text-sm">Cookie policy</p>
                <p class="white-text text-sm">Privacy policy</p>
                <p class="white-text text-sm">Cookie settings</p>
            </div>
        </div>


        <!-- opening hours -->
        <div>
            <h4 class="pb-2 white-headline">Opening hours</h4>
            <div class="flex flex-col gap-2">
                <?php foreach ($getOpeningHour as $openingHour): ?>
                    <div>
                        <p class="white-text text-sm"><?php echo htmlspecialchars(trim($openingHour['Day'])); ?></p>
                        <p class="pb-4 white-text text-sm"><?php echo htmlspecialchars(trim($openingHour['Time'])); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <!-- social media -->
        <div class="flex justify-around gap-10">
            <div>
                <h4 class="pb-2 white-headline">Follow us</h4>
                <div class="flex gap-2">
                    <img src="img/facebook.svg" alt="facebook" height="26">
                    <img src="img/instagram.svg" alt="instagram" height="26">
                </div>
            </div>
        </div>
    </div>

    <!-- copyright -->
    <div class="footer-bottom">
        <p class="extra-light">© 2024 GHIBLIFILMS</p>
    </div>
</footer>