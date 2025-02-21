<!-- cast -->
<section class="pt-20 pb-20">
    <!-- voice actors  -->
    <div class="half ten-percent pb-8">
        <div class="flex">
            <h4 class="pb-2">Voice actors</h4>
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
            <h4 class="pb-2">Production team</h4>
        </div>
        
    <!-- list of production team  -->
    <div>
        <div class="flex flex-col w-full"> 
        <h4 class="pb-2">Production team</h4>
        
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