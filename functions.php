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

function display_contact_button() {
    echo '<button class="open-contact-modal">CONTACT</button>';
}
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
    wp_enqueue_script('filtre-js', get_template_directory_uri() . '/js/filtre.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

?>