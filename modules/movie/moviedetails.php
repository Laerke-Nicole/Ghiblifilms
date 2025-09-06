<section>
    <div class="container grid grid-cols-2 gap-6 pt-10">
        <!-- movie img -->
        <div class="flex justify-center">
            <img src="upload/<?php echo htmlspecialchars(trim($movieItem['MovieImg'])); ?>" alt="Image of movie" class="movie-detail-img round-corner mr-14">
        </div>

        <!-- movie info -->
        <div class="movie-info-container sticky top-20 self-start pr-4">
            <!-- title and description -->
            <div>
                <h1><?php echo htmlspecialchars(trim($movieItem['Name'])); ?></h1>
                <p class="mb-4"><?php echo htmlspecialchars(trim($movieItem['Description'])); ?></p>
                <a href="#showings"><button class="btn-two mb-10">See times</button></a>
            </div>

            <!-- key info -->
            <div class="key-info flex flex-col gap-4 mb-10">
                <div>
                    <h5>Duration</h5>
                    <p><?php echo htmlspecialchars(trim($movieItem['Duration'])); ?></p>
                </div>
                <div>
                    <h5>Release year</h5>
                    <p><?php echo htmlspecialchars(trim($movieItem['ReleaseYear'])); ?></p>
                </div>
                <div>
                    <h5>Genre</h5>
                    <p><?php echo htmlspecialchars(implode(", ", array_column($genres, 'GenreName'))); ?></p>
                </div>
            </div>

            <!-- voice actors -->
            <div class="pb-4">
                <button class="toggle-dropdown w-full text-left black-text text-sm" onclick="toggleAccordion('voiceActors', this)">Voice actors<span class="arrow"></span>
                </button>
                <div id="voiceActors" class="accordion-content hidden pl-4 pt-2">
                    <?php foreach ($voiceActor as $actor): ?>
                        <p class="black-text text-base"><?php echo htmlspecialchars(trim($actor['FirstName'])) . ' ' . htmlspecialchars(trim($actor['LastName'])); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- production team -->
            <div class="pb-4 md:pb-0">
                <button class="toggle-dropdown w-full text-left black-text text-sm" onclick="toggleAccordion('productionTeam', this)">Production team<span class="arrow"></span>
                </button>
                <div id="productionTeam" class="accordion-content hidden pl-4 pt-2">
                    <?php foreach ($production as $prod): ?>
                        <div class="flex justify-between gap-4 pb-1">
                            <p class="role text-base font-medium"><?php echo htmlspecialchars(trim($prod['NameOfRole'])); ?></p>
                            <p class="name text-base"><?php echo htmlspecialchars(trim($prod['FirstName'])) . ' ' . htmlspecialchars(trim($prod['LastName'])); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
