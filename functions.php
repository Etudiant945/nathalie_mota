<?php
//  Pour faire apparaitre le menu du Header 
function mon_theme_register_menus() {
    register_nav_menus(
        array(
            'header_menu' => 'Menu Principal de l\'En-tête', // Nom de l'emplacement du menu
        )
    );
}
add_action('after_setup_theme', 'mon_theme_register_menus');
?>

<?php
// Fonction pour ajouter les scripts et les styles
function ajouter_styles_et_scripts() {
    // Ajouter le fichier CSS principal
    wp_enqueue_style(
        'theme-style',
        get_template_directory_uri() . '/style.css',
        array(),
        null,
        'all'
    );

    // Charger le script JS pour la modale
    wp_enqueue_script('custom-modal-script', get_template_directory_uri() . '/js/modal.js', array('jquery'), null, true);

    // Charger le script pour le menu hamburger
    wp_enqueue_script('hamburger-menu', get_template_directory_uri() . '/js/menu-hamburger.js', array(), null, true);

     // Charger le script pour l'agrandissement de photo
     wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ajouter_styles_et_scripts');

?>

<?php
//  Pour faire apparaitre le menu du footer 
function register_my_menus() {
    register_nav_menus(array(
        'footer-menu' => __('Footer Menu'),
    ));
}
add_action('init', 'register_my_menus');
?>

<?php
function theme_enqueue_scripts() {
    wp_enqueue_script('filtre', get_template_directory_uri() . '/js/filtre.js', array('jquery'), null, true);
    // Ajout d'Ajax URL pour WordPress
    wp_localize_script('filtre', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
function load_more_photos() {
    // Récupérer les paramètres de la requête AJAX
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $categorie = isset($_GET['categorie']) ? $_GET['categorie'] : 'all';
    $format = isset($_GET['format']) ? $_GET['format'] : 'all';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'DESC';

    // Arguments pour la requête WordPress
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,  // Utilisation du paramètre de page
    );

    // Filtrer par catégorie
    if ($categorie != 'all') {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => sanitize_text_field($categorie),
        );
    }

    // Filtrer par format
    if ($format != 'all') {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => sanitize_text_field($format),
        );
    }

    // Trier par date
    if ($sort) {
        $args['orderby'] = 'date';
        $args['order'] = sanitize_text_field($sort);
    }

    // Exécution de la requête
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
    
    <article class="article-item" data-url="<?php echo get_permalink(); ?>">
    <?php 
    $image = get_field('photo'); 
    $reference = get_field('reference');
    $categories = get_the_terms(get_the_ID(), 'categorie');
    $category_names = !empty($categories) ? implode(', ', wp_list_pluck($categories, 'name')) : 'Non classé';
    ?>
    <div class="article-image">
        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
        
        <!-- Icône de zoom (qui ouvre la modale) -->
        <a href="#" class="icon-link enlarge-photo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/Icon_zoom.png" alt="Agrandir" class="icon">
        </a>
        <!-- Informations affichées au survol -->
        <div class="overlay">
            <p class="reference"><?php echo esc_html($reference); ?></p>
            <p class="categories"><?php echo esc_html($category_names); ?></p>
        </div>
        
        <!-- Icône de redirection (l'icône de l'œil) -->
        <a href="<?php echo get_permalink(); ?>" class="icon-link">
            <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/Icon_eye.png" alt="Voir la photo" class="icon">
        </a>
    </div>
    <div class="article-content"></div>
</article>



        <?php endwhile;
    endif;

    wp_reset_postdata();
    
    die();  // Fin de la requête AJAX
}



// Définir les actions AJAX
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

?>

