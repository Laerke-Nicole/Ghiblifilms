<!-- cast -->
<section class="pt-24 pb-24">
    <!-- voice actors  -->
    <div class="half ten-percent pb-24">
        <div class="flex">
            <h3>VOICE ACTORS</h3>
        </div>
            <div class="flex flex-col w-half">
                <!-- loop with voice actors -->
                <?php foreach ($voiceActor as $voiceActor): ?>
                    <p class="primary-font secondary-color text-lg"><?php echo htmlspecialchars(trim($voiceActor['FirstName'])) . ' ' . htmlspecialchars(trim($voiceActor['LastName'])) ?></p>
                <?php endforeach; ?>
            </div> 
    </div>


    <!-- production team  -->
    <div class="flex justify-between ten-percent pb-12">
        <div class="flex">
            <h3>PRODUCTION TEAM</h3>
        </div>
        
    <!-- list of production team  -->
    <div>
        <div class="flex flex-col w-full"> 
        
        <?php foreach ($production as $prod): ?>
            <div class="flex items-center justify-between gap-6 pb-2"> 
                <!-- role -->
                <div class="flex-shrink-0 w-33 text-right">
                    <p class="primary-font secondary-color text-lg"><?php echo htmlspecialchars(trim($prod['NameOfRole'])); ?></p>
                </div>
                
                <!-- first and last name -->
                <div class="flex-1">
                    <p class="secondary-color text-lg"><?php echo htmlspecialchars(trim($prod['FirstName'])) . ' ' . htmlspecialchars(trim($prod['LastName'])); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>

</section>