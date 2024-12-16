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
