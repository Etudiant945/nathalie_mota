<?php
// 🔹 Enregistre les menus
function mon_theme_register_menus() {
    register_nav_menus(array(
        'header_menu' => __('Menu Principal de l\'En-tête'),
        'footer-menu' => __('Menu Pied de page'),
    ));
}
add_action('after_setup_theme', 'mon_theme_register_menus');


// 🔹 Enqueue styles & scripts
function mon_theme_enqueue_assets() {
    // CSS
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css');

    // Select2 (CDN)
    wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
    wp_enqueue_script('select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', ['jquery'], null, true);

    // FontAwesome
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');

    // Scripts JS
    wp_enqueue_script('modal', get_template_directory_uri() . '/js/modal.js', ['jquery'], null, true);
    wp_enqueue_script('hamburger-menu', get_template_directory_uri() . '/js/menu-hamburger.js', [], null, true);
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', ['jquery'], null, true);
    wp_enqueue_script('lightbox-single', get_template_directory_uri() . '/js/lightbox-single.js', ['jquery'], null, true);

    // Filtres dynamiques + AJAX (page d'accueil)
    if (is_front_page() || is_home()) {
        wp_enqueue_script('filtre', get_template_directory_uri() . '/js/filtre.js', ['jquery', 'select2-js'], null, true);
        wp_localize_script('filtre', 'ajaxurl', admin_url('admin-ajax.php'));
    }
}
add_action('wp_enqueue_scripts', 'mon_theme_enqueue_assets');


// 🔹 AJAX : Chargement dynamique des photos (accueil)
function load_more_photos() {
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $categorie = sanitize_text_field($_GET['categorie'] ?? 'all');
    $format = sanitize_text_field($_GET['format'] ?? 'all');
    $sort = sanitize_text_field($_GET['sort'] ?? 'DESC');

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,
        'orderby' => 'date',
        'order' => $sort,
    );

    // Tax queries
    $tax_query = [];

    if ($categorie !== 'all') {
        $tax_query[] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $categorie,
        );
    }

    if ($format !== 'all') {
        $tax_query[] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $format,
        );
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $image = get_field('photo');
            $reference = get_field('reference');
            $categories = get_the_terms(get_the_ID(), 'categorie');
            $category_names = !empty($categories) ? implode(', ', wp_list_pluck($categories, 'name')) : 'Non classé';
            ?>
            <article class="article-item" data-url="<?php echo get_permalink(); ?>">
                <div class="article-image">
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">

                    <a href="#" class="icon-link enlarge-photo">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/Icon_zoom.png" alt="Agrandir" class="icon">
                    </a>

                    <div class="overlay">
                        <p class="reference"><?php echo esc_html($reference); ?></p>
                        <p class="categories"><?php echo esc_html($category_names); ?></p>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="icon-link">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/Icon_eye.png" alt="Voir la photo" class="icon">
                    </a>
                </div>
            </article>
            <?php
        endwhile;
    endif;

    wp_reset_postdata();
    wp_die(); 
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
