<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <div class="container header-wrapper">
            <a href="<?php echo home_url(); ?>">
                <img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/Logo.png" alt="Logo">
            </a>
            <!-- Bouton du menu hamburger -->
            <button class="menu-toggle" aria-label="Ouvrir le menu">
                <div></div>
                <div></div>
                <div></div>
            </button>
            <div class="header-content">
                <?php
        wp_nav_menu(array(
            'theme_location' => 'header_menu', 
            'container' => 'nav',
            'container_class' => 'menu-header',
            'menu_class' => 'menu', 
        ));
    ?>
            </div>
        </div>
    </header>