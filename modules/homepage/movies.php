<head>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>

<section class="container">   
    <h2>Movies in our cinema</h2> 

    <!-- Slider main container -->
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?php foreach ($getMovies as $getMovie): ?>
                <div class="swiper-slide">
                    <a onclick="window.location.href='index.php?page=moviedetail&ID=<?php echo htmlspecialchars(trim($getMovie['MovieID'])); ?>'">
                        <img src='upload/<?php echo htmlspecialchars(trim($getMovie['MovieImg'])); ?>' alt='Image of movie' class="movie-list-img round-corner movie-img">
                        
                        <div class="flex flex-col">
                            <div>
                                <h5><?php echo htmlspecialchars(trim($getMovie['Name'])); ?></h5>
                                <p class="mb-4 text-sm"><?php echo htmlspecialchars(trim($getMovie['ReleaseYear'])); ?></p>
                            </div>
                            
                            <div>
                                <button class="btn-two">Get tickets</button>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>