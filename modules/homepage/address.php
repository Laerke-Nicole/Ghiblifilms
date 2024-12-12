<section>
    <!-- display company address info  -->
    <div class="ten-percent pb-24">
          
        <?php foreach ($getCompanyAddressView as $companyAddress): ?>
            <h5>Find <?php echo htmlspecialchars(trim($companyAddress['NameOfCompany'])); ?> address:</h5>
            <div>
                <p><?php echo htmlspecialchars(trim($companyAddress['StreetName'])); ?></p>
                <p><?php echo htmlspecialchars(trim($companyAddress['StreetNumber'])); ?></p>
            </div>

            <div>
                <p><?php echo htmlspecialchars(trim($companyAddress['PostalCode'])); ?></p>
                <p><?php echo htmlspecialchars(trim($companyAddress['City'])); ?></p>
                <p><?php echo htmlspecialchars(trim($companyAddress['Country'])); ?></p>
                <p><?php echo htmlspecialchars(trim($companyAddress['City'])); ?></p>
            </div>
        <?php endforeach; ?>

    </div>
</section>