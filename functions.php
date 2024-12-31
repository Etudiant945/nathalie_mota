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
// Fonction pour ajouter les scripts et les styles
function ajouter_styles_et_scripts() {
    // Ajouter le fichier CSS
    wp_enqueue_style(
        'theme-style', // Identifiant unique pour ce style
        get_template_directory_uri() . '/style.css', // Le chemin du fichier CSS
        array(), // Les dépendances (aucune ici)
        null, // Version (optionnel, vous pouvez utiliser une version ici)
        'all' // Media (ex: 'all', 'screen', 'print')
    );

    // Charger le script JS pour la modale
    wp_enqueue_script('custom-modal-script', get_template_directory_uri() . '/js/modal.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ajouter_styles_et_scripts');
?>


<?php
function display_contact_button() {
    echo '<button class="open-contact-modal">CONTACT</button>';
}


?>

<?php
function register_my_menus() {
    register_nav_menus(array(
        'footer-menu' => __('Footer Menu'),
    ));
}
add_action('init', 'register_my_menus');
?>

