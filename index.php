<?php get_header(); ?>

<section class="container filters-and-posts-container">
    <div class="filters-container">
        <div class="category-format-filters">
            <!-- Filter Categories -->
            <div class="categories-filter">
                <form class="filter-column">
                    <select id="categories" class="filters-container__photo-filter">
                        <option value="all" hidden></option>
                        <option value="all" selected>CATÉGORIES</option>
                        <?php
                        $categories = get_terms(array(
                            "taxonomy" => "categorie", // as in CPT UI
                            "hide_empty" => false,
                        ));
                        foreach ($categories as $categorie) {
                            echo '<option value="' . $categorie->slug . '">' . mb_convert_case($categorie->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                    </select>
                </form>
                <!-- Le bouton flèche -->
                <button type="button" class="filters-container__photo-filter__arrow">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/arrow-down.png"
                        alt="flèche vers le bas">
                </button>
            </div>

            <!-- Filter Formats -->
            <div class="formats-filter">
                <form class="filter-column">
                    <select id="formats" class="filters-container__photo-filter">
                        <option value="all" hidden></option>
                        <option value="all" selected>FORMATS</option>
                        <?php
                        $formats = get_terms(array(
                            "taxonomy" => "format", // as in CPT UI
                            "hide_empty" => false,
                        ));
                        foreach ($formats as $format) {
                            echo '<option value="' . $format->slug . '">' . mb_convert_case($format->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                    </select>
                </form>
                <!-- Le bouton flèche -->
                <button type="button" class="filters-container__photo-filter__arrow">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/arrow-down.png"
                        alt="flèche vers le bas">
                </button>
            </div>
        </div>

        <!-- Filter Sort By Date -->
        <div class="sort-by-date-filter">
            <form class="filter-column">
                <select id="sort-by-date" class="filters-container__photo-filter">
                    <option value="all" hidden></option>
                    <option value="all" selected>TRIER PAR</option>
                    <option value="DESC">Les Plus Récentes</option>
                    <option value="ASC">Les Plus Anciennes</option>
                </select>
                <!-- Le bouton flèche -->
                <button type="button" class="filters-container__photo-filter__arrow">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/arrow-down.png"
                        alt="flèche vers le bas">
                </button>
            </form>
        </div>

    </div>
</section>

<section class="container article-list"> 
<?php
// Arguments pour la requête WordPress
$args = array(
    'post_type' => 'photo', // Remplacez par votre CPT, ici "photo"
    'posts_per_page' => 10, // Nombre d'articles à afficher (modifiez si nécessaire)
);

// Si un filtre de catégorie est appliqué
if (isset($_GET['categorie']) && $_GET['categorie'] != 'all') {
    $args['tax_query'][] = array(
        'taxonomy' => 'categorie', // Taxonomie pour les catégories
        'field' => 'slug', // Utilisation du slug pour filtrer
        'terms' => $_GET['categorie'], // Le terme sélectionné
    );
}

// Si un filtre de format est appliqué
if (isset($_GET['format']) && $_GET['format'] != 'all') {
    $args['tax_query'][] = array(
        'taxonomy' => 'format', // Taxonomie pour les formats
        'field' => 'slug', // Utilisation du slug pour filtrer
        'terms' => $_GET['format'], // Le format sélectionné
    );
}

// Si un tri par date est appliqué
if (isset($_GET['sort']) && ($_GET['sort'] == 'ASC' || $_GET['sort'] == 'DESC')) {
    $args['order'] = $_GET['sort']; // Tri par date
    $args['orderby'] = 'date'; // Tri basé sur la date
}

// Exécution de la requête
$query = new WP_Query($args);

// Si des articles sont trouvés
if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        ?>
<article class="article-item">

    <?php 
$image = get_field('photo'); // Remplacez 'photo_image' par le nom de votre champ ACF

if ($image) : ?>
    <div class="article-image">
        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
        <!-- Utilisez l'URL pour l'image -->
    </div>
    <?php else : ?>
    <p>Pas d'image disponible</p>
    <?php endif; ?>

    <!-- Contenu ou extrait de l'article -->
    <div class="article-content"><?php the_excerpt(); ?></div>
</article>
<?php
    endwhile;

    // Pagination si nécessaire
    the_posts_pagination();
else :
    echo '<p>Aucun article trouvé.</p>';
endif;

// Réinitialisation des données de la requête après utilisation
wp_reset_postdata();
?>
</section>

<?php get_footer(); ?>