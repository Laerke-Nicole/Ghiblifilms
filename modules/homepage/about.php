<section id="about-us">
    <div class="about-ghiblifilms flex pt-20 pb-20 justify-around">
        <!-- text about the company -->
        <?php foreach ($getAboutCompany as $about): ?>
            <div class="flex-1 max-w-xs">
                <h2 class="primary-color text-6xl">About<br><?= htmlspecialchars(trim($about['NameOfCompany'])) ?></h2>
            </div>
            <div class="flex-1 max-w-lg">
                <p class="primary-color primary-font text-lg"><?= htmlspecialchars(trim($about['CompanyDescription'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>