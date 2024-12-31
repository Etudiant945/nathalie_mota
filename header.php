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

            <div class="header-content">
                <?php
                    // Afficher le menu principal
                    wp_nav_menu(array(
                        'theme_location' => 'header_menu', 
                        'container' => 'nav',
                        'container_class' => 'menu-header',
                        'menu_class' => 'menu', 
                    )); 
                 ?>
                <?php display_contact_button(); ?>
            </div>


        </div>
    </header>