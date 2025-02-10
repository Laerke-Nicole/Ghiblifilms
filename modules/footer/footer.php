<?php require_once("controllers/companyController.php"); ?>

<footer class="footer">
    <div class="footer-container">
        <!-- left side -->
        <div class="footer-left">
            <h3>Ghiblifilms</h3>
            <?php foreach ($companyMailPhone as $companyInfo): ?>
                <p><?php echo htmlspecialchars(trim($companyInfo['CompanyEmail'])); ?></p>
                <p>+45 <?php echo htmlspecialchars(trim($companyInfo['CompanyPhoneNumber'])); ?></p>
            <?php endforeach; ?>
        </div>

        <!-- right side -->
        <div>
            <h5>About Us</h5>
            <a href="index.php?page=about" class="footer-link">About Ghiblifilms</a><br>
            <a href="index.php?page=contact" class="footer-link">Contact Us</a>
        </div>
    </div>

    <!-- copyright -->
    <div class="footer-bottom">
        <p>© 2024 GHIBLIFILMS</p>
    </div>
</footer>