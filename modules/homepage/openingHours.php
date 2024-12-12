<section>
    <div class="ten-percent pb-24">
               
        <h5>Opening hours:</h5>
        <?php foreach ($getOpeningHour as $openingHour): ?>
            <div>
                <p class="text-sm"><?php echo htmlspecialchars(trim($openingHour['Day'])); ?></p>
                <p class="pb-4 text-sm"><?php echo htmlspecialchars(trim($openingHour['Time'])); ?></p>
            </div>
        <?php endforeach; ?>
        
    </div>
</section>