<section>
    <div class="grid-1-2 pt-8 pb-20 five-percent">
        <!-- img of movie  -->
        <div class="flex justify-center">
            <img src="upload/<?php echo htmlspecialchars(trim($movieItem['MovieImg'])); ?>" alt="Image of movie" class="movie-detail-img round-corner">
        </div>

        <!-- info  -->
        <div class="pt-16 pl-8">
            <!-- title and description  -->
            <div class="pb-12">
                <h1 class="pb-4"><?php echo htmlspecialchars(trim($movieItem['Name'])); ?></h1>
                <p class="pb-4"><?php echo htmlspecialchars(trim($movieItem['Description'])); ?></p>
                <a href="#showings"><button class="btn-two">See times</button></a>
            </div>
        
            <!-- key info  -->
            <div class="flex flex-col gap-2">
                <!-- duration -->
                <div>
                    <h4 class="text-sm">Duration</h4>
                    <p><?php echo htmlspecialchars(trim($movieItem['Duration'])); ?></p>
                </div>

                <!-- release date  -->
                <div>
                    <h4 class="text-sm">Release year</h4>
                    <p><?php echo htmlspecialchars(trim($movieItem['ReleaseYear'])); ?></p>
                </div>

                <!-- genre  -->
                <div>
                    <h4 class="text-sm">Genre</h4>
                    
                    <!-- display genres in an array with , between each name -->
                    <?php $genreNames = array_column($genres, 'GenreName'); ?>
                    <p><?php echo htmlspecialchars(implode(", ", $genreNames)); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>