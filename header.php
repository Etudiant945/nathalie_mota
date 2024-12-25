<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="header-content">
            <div><?php bloginfo( 'name' ); ?></div>
            <?php
            // Afficher le menu principal
            wp_nav_menu(array(
                'theme_location' => 'header_menu', 
                'container' => 'nav',
                'container_class' => 'menu-header',
                'menu_class' => 'menu',
            ));
            ?>
        </div>
    </header>

    <button class="open-contact-modal">Contactez-nous</button>


