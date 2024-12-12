<div class="w-half">
    <div class="box">
        
        <h3 class="text-xl pb-4">Prefer a direct contact? You can reach us via email or phone:</h3>
        
            <div class="flex flex-col gap-6">
            <?php foreach ($getCompanyInformation as $companyInfo): ?>
                <div>
                    <h4 class="text-sm">Email us</h4>
                    <p><?php echo htmlspecialchars(trim($companyInfo['CompanyEmail'])); ?></p>
                </div>
                <div>
                    <h4 class="text-sm">Call us</h4>
                    <p><?php echo htmlspecialchars(trim($companyInfo['CompanyPhoneNumber'])); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>