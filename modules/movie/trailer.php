<section>
    <div class="trailer container">
        <h3 class="black-headline">Watch the trailer</h3>
        <div class="trailer-video">
        <?php if ($movieItem): ?>
            <?php 
                $trailerUrl = htmlspecialchars(trim($movieItem['MovieTrailer']));
                $embedUrl = str_replace("watch?v=", "embed/", $trailerUrl);
            ?>
            <iframe width="560" height="315" 
                src="<?php echo $embedUrl; ?>" 
                title="YouTube video player" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                referrerpolicy="strict-origin-when-cross-origin" 
                allowfullscreen>
            </iframe>
        <?php endif; ?>

        </div>
    </div>
</section>