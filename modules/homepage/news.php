<?php 
echo '<section class="pt-24 pb-24 ten-percent" id="news">';
    echo '<div>';
        echo '<h2 class="text-center pb-4">NEWS</h2>';
    echo '</div>';
    
    // loop with news 
    echo '<div class="items">';
        foreach ($getNews as $news) {
            echo '<div>';
                echo "<img src='upload/" . htmlspecialchars(trim($news['NewsImg'])) . "' alt='Image of news'>";
                echo '<h5 class="weight-400 pb-2">' . htmlspecialchars(trim($news['Headline'])) . '</h5>';
                echo '<button class="btn" onclick="window.location.href=\'index.php?page=newsdetail&ID=' . htmlspecialchars(trim($news['NewsID'])) . '\'">See more</button>';
            echo '</div>';
        }
    echo '</div>';

echo '</section>';