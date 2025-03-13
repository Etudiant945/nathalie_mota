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
}
add_action('wp_enqueue_scripts', 'ajouter_styles_et_scripts');

?>
<?php // appel de ma fonction js pour mon filtre
function enqueue_custom_scripts() {
    // Assurez-vous que jQuery est chargé avant votre script
    wp_enqueue_script('jquery'); // Inclure jQuery si nécessaire

    // Charger le script personnalisé
    wp_enqueue_script(
        'custom-script', // Identifiant pour le script
        get_template_directory_uri() . '/js/script.js', // Chemin du script
        array('jquery'), // Dépendance jQuery
        null, // Version
        true // Charger dans le footer
    );
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
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
    // Récupérer les paramètres
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $categorie = isset($_GET['categorie']) ? $_GET['categorie'] : 'all';
    $format = isset($_GET['format']) ? $_GET['format'] : 'all';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'DESC';

    // Arguments pour la requête
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,  // Utilise le paramètre de page
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
    endif;

    wp_reset_postdata();
    
    die();  // Terminer l'exécution de l'Ajax
}

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');


?>
