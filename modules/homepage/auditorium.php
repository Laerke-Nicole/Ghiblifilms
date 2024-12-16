<section>
    <!-- display venues -->
    <div class="ten-percent pb-24">
           
        <h5>All our venues:</h5>
        <div>
            <?php foreach ($getAuditorium as $auditorium): ?>
                <p><?php echo htmlspecialchars(trim($auditorium['AuditoriumNumber'])); ?></p>
            <?php endforeach; ?>
        </div>

    </div>
</section>