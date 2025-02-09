<?php require_once("controllers/companyController.php"); ?>

<section>
    <div class="flex justify-center align-center">
        <img src="img/logo.png" alt="Studio Ghibli logo" class="h-350">
    </div>

    <div class="flex flex-col justify-center align-center text-center pb-8">
        <?php foreach ($getAboutCompany as $about): ?>
            <div class="flex-1 max-w-xs">
                <h1 class="pb-2">About Ghiblifilms</h1>
            </div>
            <div class="flex-1 max-w-lg">
                <p><?= htmlspecialchars(trim($about['CompanyDescription'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="flex justify-center">
        <img src="img/star-divider.svg" alt="divider" class="h-80">
    </div>

    <div class="pt-8">
    <!-- Opening Hours Section -->
        <div class="text-center">
            <h5>Opening hours</h5>
            <?php foreach ($getOpeningHour as $openingHour): ?>
                <div>
                    <p class="text-sm"><?php echo htmlspecialchars(trim($openingHour['Day'])); ?></p>
                    <p class="pb-4 text-sm"><?php echo htmlspecialchars(trim($openingHour['Time'])); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Find Us Section -->
        <div class="flex flex-col justify-center align-center">
            <?php foreach ($getCompanyAddressView as $companyAddress): ?>
                <h5>Find us</h5>
                <div class="flex flex-col justify-center align-center">
                    <p><?php echo htmlspecialchars(trim($companyAddress['StreetName'])); ?> 
                    <?php echo htmlspecialchars(trim($companyAddress['StreetNumber'])); ?>
                    </p>
                    <p><?php echo htmlspecialchars(trim($companyAddress['PostalCode'])); ?> 
                    <?php echo htmlspecialchars(trim($companyAddress['City'])); ?>
                    </p>
                    <p><?php echo htmlspecialchars(trim($companyAddress['Country'])); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>