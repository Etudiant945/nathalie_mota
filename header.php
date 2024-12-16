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
        <div class="header-content">
            <h1><?php bloginfo( 'name' ); ?></h1>
            <p><?php bloginfo( 'description' ); ?></p>
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
