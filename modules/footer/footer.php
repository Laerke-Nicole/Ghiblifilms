<?php require_once("controllers/companyController.php"); ?>

<footer>
    <div class="footer-content flex justify-between container container-footer">
        <!-- company info -->
        <div>
            <h3 class="text-2xl uppercase white-headline primary-font">Ghiblifilms</h3>
            <?php foreach ($everythingCompany as $companyInfo): ?>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col">
                    <p class="extra-light text-sm">+45 <?php echo htmlspecialchars(trim($companyInfo['CompanyPhoneNumber'])); ?></p>
                    <p class="extra-light text-sm"><?php echo htmlspecialchars(trim($companyInfo['CompanyEmail'])); ?></p>
                </div>
                <?php endforeach; ?>

                <?php foreach ($getCompanyAddressView as $companyAddress): ?>
                    <div>
                        <p class="extra-light text-sm"><?php echo htmlspecialchars(trim($companyAddress['StreetName'])); ?> <?php echo htmlspecialchars(trim($companyAddress['StreetNumber'])); ?></p>
                        <p class="extra-light text-sm"><?php echo htmlspecialchars(trim($companyAddress['PostalCode'])); ?> <?php echo htmlspecialchars(trim($companyAddress['City'])); ?></p>
                        <p class="extra-light text-sm"><?php echo htmlspecialchars(trim($companyAddress['Country'])); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- about us links -->
        <div>
            <h5 class="text-lg footer-headlines white-headline">About Us</h5>
            <div class="flex flex-col gap-2">
                <a href="index.php?page=movies" class="footer-link white-text"><p>Movies</p></a>
                <a href="index.php?page=about" class="footer-link white-text"><p>About Ghiblifilms</p></a>
                <a href="index.php?page=contact" class="footer-link white-text"><p>Contact Us</p></a>
                <p class="white-text text-base white-text">Job at Ghiblifilms</p>
                <p class="white-text text-base white-text">Membership</p>
            </div>
        </div>


        <!-- opening hours -->
        <div>
            <h5 class="text-lg footer-headlines white-headline">Opening hours</h5>
            <div class="flex flex-col">
                <?php foreach ($getOpeningHour as $openingHour): ?>
                    <div class="opening-hours">
                        <p class="white-text text-sm"><?php echo htmlspecialchars(trim($openingHour['Day'])); ?></p>
                        <p class="white-text text-sm"><?php echo htmlspecialchars(trim($openingHour['Time'])); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <!-- social media -->
        <div>
            <div>
                <h5 class="text-lg footer-headlines white-headline">Follow us</h5>
                <div class="flex gap-2">
                    <img src="img/facebook.svg" alt="facebook" class="h-5">
                    <img src="img/instagram.svg" alt="instagram"  class="h-5">
                </div>
            </div>
        </div>
    </div>

    <!-- copyright -->
    <div class="footer-bottom">
        <p class="extra-light">© 2024 GHIBLIFILMS</p>
    </div>
</footer>