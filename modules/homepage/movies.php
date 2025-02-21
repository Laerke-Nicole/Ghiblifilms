<head>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>

<section class="pt-16 pb-16 movies-container">   
    <h2 class="pb-6">Movies in our cinema</h2> 

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach ($getMovies as $getMovie): ?>
                <div class="swiper-slide">
                    <img src='upload/<?php echo htmlspecialchars(trim($getMovie['MovieImg'])); ?>' alt='Image of movie' class="round-corner movie-img">
                    
                    <h5><?php echo htmlspecialchars(trim($getMovie['Name'])); ?></h5>
                    <p class="pb-4"><?php echo htmlspecialchars(trim($getMovie['ReleaseYear'])); ?></p>
                    
                    <button class="btn-two" 
                    onclick="window.location.href='index.php?page=moviedetail&ID=<?php echo htmlspecialchars(trim($getMovie['MovieID'])); ?>'">
                    Get tickets</button>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Navigation buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>