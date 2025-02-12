<?php
$tax_query = array('relation' => 'AND');

if (!empty($_GET['categorie']) && $_GET['categorie'] != 'all') {
    $tax_query[] = array(
        'taxonomy' => 'categorie',
        'field' => 'slug',
        'terms' => sanitize_text_field($_GET['categorie']),
    );
}

if (!empty($_GET['format']) && $_GET['format'] != 'all') {
    $tax_query[] = array(
        'taxonomy' => 'format',
        'field' => 'slug',
        'terms' => sanitize_text_field($_GET['format']),
    );
}

$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 8,
    'tax_query' => count($tax_query) > 1 ? $tax_query : '',
    'orderby' => 'date',
    'order' => isset($_GET['sort']) && in_array($_GET['sort'], ['ASC', 'DESC']) ? $_GET['sort'] : 'DESC',
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post(); ?>
        <article class="article-item">
            <?php 
            $image = get_field('photo');
            if ($image) : ?>
                <div class="article-image">
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                </div>
            <?php else : ?>
                <p>Pas d'image disponible</p>
            <?php endif; ?>

            <div class="article-content"><?php the_excerpt(); ?></div>
        </article>
    <?php endwhile;

    the_posts_pagination();
else :
    echo '<p>Aucun article trouvé.</p>';
endif;

wp_reset_postdata();
?>