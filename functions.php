<?php
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
function enqueue_custom_scripts() {
    // Chargement du script JS pour la modale
    wp_enqueue_script('custom-modal-script', get_template_directory_uri() . '/js/modal.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
?>