<?php require_once("controllers/movieController.php"); ?>

<head>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>

<section class="container pt-10">   
    <h2>Movies in our cinema</h2> 

    <!-- Slider main container -->
    <div class="swiper-movies">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?php foreach ($getMovies as $getMovie): ?>
                <div class="swiper-slide swiper-slide-movie-list dark-bg round-corner">
                    <a onclick="window.location.href='index.php?page=moviedetail&ID=<?php echo htmlspecialchars(trim($getMovie['MovieID'])); ?>'">
                        <div class="flex flex-col md:flex-row h-full">
                            <!-- Left side: text -->
                            <div class="flex-1 flex flex-col justify-center p-4 movie-page-text">
                                <div class="mb-4">
                                    <p class="text-xs white-text border p-1 inline-block"><?php echo htmlspecialchars(trim($getMovie['ReleaseYear'])); ?></p>
                                </div>
                                <div>
                                    <h2 class="white-headline"><?php echo htmlspecialchars(trim($getMovie['Name'])); ?></h2>
                                    <p class="text-sm white-text"><?php echo htmlspecialchars(trim($getMovie['Description'])); ?></p>
                                </div>
                            </div>

                            <!-- Right side: image -->
                            <div class="flex-1">
                                <img src='upload/<?php echo htmlspecialchars(trim($getMovie['MovieImg'])); ?>' 
                                    alt='Image of movie' 
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        <div class="swiper-pagination"></div>
    </div>
</section>