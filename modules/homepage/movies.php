<section class="pb-24 ten-percent" id="movies">
    <div>
        <h2 class="text-center pb-4">All of our movies</h2>
    </div>
    
    <!-- loop with movies -->
    <div class="items">
        
        <?php foreach ($getMovies as $getMovie): ?>
            <div>
                <img src='upload/<?php echo htmlspecialchars(trim($getMovie['MovieImg'])); ?>' alt='Image of movie'>
                <h5 class="weight-400 pb-2"><?php echo htmlspecialchars(trim($getMovie['Name'])); ?></h5>
                <button class="btn" 
                onclick="window.location.href='index.php?page=moviedetail&ID=<?php echo htmlspecialchars(trim($getMovie['MovieID'])); ?>'">
                Get tickets</button>
            </div>
        <?php endforeach; ?>
    </div>

</section>