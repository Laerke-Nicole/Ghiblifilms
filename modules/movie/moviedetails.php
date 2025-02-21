<section>
    <div class="grid-1-2 pt-8 pb-20 five-percent">
        <!-- movie img -->
        <div class="flex justify-center">
            <img src="upload/<?php echo htmlspecialchars(trim($movieItem['MovieImg'])); ?>" alt="Image of movie" class="movie-detail-img round-corner">
        </div>

        <!-- movie info -->
        <div class="pt-16 pl-8">
            <!-- title and description -->
            <div class="pb-12">
                <h1 class="pb-4"><?php echo htmlspecialchars(trim($movieItem['Name'])); ?></h1>
                <p class="pb-4"><?php echo htmlspecialchars(trim($movieItem['Description'])); ?></p>
                <a href="#showings"><button class="btn-two">See times</button></a>
            </div>

            <!-- key info -->
            <div class="flex flex-col gap-2 pb-8">
                <div>
                    <h4 class="text-sm">Duration</h4>
                    <p><?php echo htmlspecialchars(trim($movieItem['Duration'])); ?></p>
                </div>
                <div>
                    <h4 class="text-sm">Release year</h4>
                    <p><?php echo htmlspecialchars(trim($movieItem['ReleaseYear'])); ?></p>
                </div>
                <div>
                    <h4 class="text-sm">Genre</h4>
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
            <div>
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
