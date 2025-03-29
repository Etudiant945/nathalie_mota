<section class="hero-section">
    <div class="hero-image">
        <?php  
      $query = new WP_Query(
        array(
            'post_type' => 'photo',
            'posts_per_page' => 1,
            'orderby' => 'rand', 
        )
        );
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        $random_image = get_field('photo'); 
        ?>

        <img src="<?php echo esc_url($random_image); ?>" alt="Image aléatoire de photographe" class="hero-img">

        <div class="hero-overlay">
            <h1 class="hero-title">Photographe event</h1>
        </div>
    </div>
    <?php endwhile; endif; ?>
</section>