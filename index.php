<?php get_header(); ?>

<section class="container filters-and-posts-container">
    <div class="filters-container">
        <div class="category-format-filters">
            <!-- Filter Categories -->
            <div class="categories-filter">
                <form class="filter-column" method="GET">
                    <select id="categories" name="categorie" class="filters-container__photo-filter" onchange="this.form.submit()">
                        <option value="all" hidden></option>
                        <option value="all" selected>CATÉGORIES</option>
                        <?php
                        $categories = get_terms(array(
                            "taxonomy" => "categorie", 
                            "hide_empty" => false,
                        ));
                        foreach ($categories as $categorie) {
                            echo '<option value="' . $categorie->slug . '" ' . (isset($_GET['categorie']) && $_GET['categorie'] == $categorie->slug ? 'selected' : '') . '>' . mb_convert_case($categorie->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                    </select>
                </form>
                <button type="button" class="filters-container__photo-filter__arrow">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/arrow-down.png" alt="flèche vers le bas">
                </button>
            </div>

            <!-- Filter Formats -->
            <div class="formats-filter">
                <form class="filter-column" method="GET">
                    <select id="formats" name="format" class="filters-container__photo-filter" onchange="this.form.submit()">
                        <option value="all" hidden></option>
                        <option value="all" selected>FORMATS</option>
                        <?php
                        $formats = get_terms(array(
                            "taxonomy" => "format", 
                            "hide_empty" => false,
                        ));
                        foreach ($formats as $format) {
                            echo '<option value="' . $format->slug . '" ' . (isset($_GET['format']) && $_GET['format'] == $format->slug ? 'selected' : '') . '>' . mb_convert_case($format->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                    </select>
                </form>
                <button type="button" class="filters-container__photo-filter__arrow">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/arrow-down.png" alt="flèche vers le bas">
                </button>
            </div>
        </div>

        <!-- Filter Sort By Date -->
        <div class="sort-by-date-filter">
            <form class="filter-column" method="GET">
                <select id="sort-by-date" name="sort" class="filters-container__photo-filter" onchange="this.form.submit()">
                    <option value="all" hidden></option>
                    <option value="all" selected>TRIER PAR</option>
                    <option value="DESC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'DESC') ? 'selected' : ''; ?>>Les Plus Récentes</option>
                    <option value="ASC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ASC') ? 'selected' : ''; ?>>Les Plus Anciennes</option>
                </select>
                <button type="button" class="filters-container__photo-filter__arrow">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/arrow-down.png" alt="flèche vers le bas">
                </button>
            </form>
        </div>
    </div>
</section>


<section class="container article-list" id="article-list"> 
<?php
// Arguments pour la requête WordPress
$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 8, 
    'paged' => 1, // On commence à la page 1
);

// Si un filtre est appliqué
if (isset($_GET['categorie']) && $_GET['categorie'] != 'all') {
    $args['tax_query'][] = array(
        'taxonomy' => 'categorie',
        'field' => 'slug',
        'terms' => sanitize_text_field($_GET['categorie']),
    );
}

if (isset($_GET['format']) && $_GET['format'] != 'all') {
    $args['tax_query'][] = array(
        'taxonomy' => 'format',
        'field' => 'slug',
        'terms' => sanitize_text_field($_GET['format']),
    );
}

if (isset($_GET['sort']) && ($_GET['sort'] == 'ASC' || $_GET['sort'] == 'DESC')) {
    $args['order'] = $_GET['sort'];
    $args['orderby'] = 'date';
}

// Exécution de la requête
$query = new WP_Query($args);

// Si des articles sont trouvés
if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        ?>
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
    <?php endwhile; ?>
    
    <button id="load-more" class="load-more-btn">Charger plus</button>
    
    <?php
else :
    echo '<p>Aucun article trouvé.</p>';
endif;

wp_reset_postdata();
?>
</section>


<?php get_footer(); ?> 