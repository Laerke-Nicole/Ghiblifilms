<section class="pb-24 six-percent" id="movies">   
    <h2 class="pb-6 text-3xl">Newest movies in our cinema</h2> 
    <!-- loop with movies -->
    <div class="items">
        <?php foreach ($getMovies as $getMovie): ?>
            <div>
                <img src='upload/<?php echo htmlspecialchars(trim($getMovie['MovieImg'])); ?>' alt='Image of movie' class="round-corner">
                <h5><?php echo htmlspecialchars(trim($getMovie['Name'])); ?></h5>
                <p class="pb-2"><?php echo htmlspecialchars(trim($getMovie['ReleaseYear'])); ?></p>
                <button class="btn-two" 
                onclick="window.location.href='index.php?page=moviedetail&ID=<?php echo htmlspecialchars(trim($getMovie['MovieID'])); ?>'">
                Get tickets</button>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<div class="six-percent">
    <hr class="dark-hr">
</div>
