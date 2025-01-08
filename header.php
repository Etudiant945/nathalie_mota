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

            

        
       
        <section class="hero-section">
            <div class="hero-image">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/nathalie-2.jpeg'); ?>" alt="Photo de la foule en plein concert" class="hero-img">
                <div class="hero-overlay">
                <h1 class="hero-title">Photographe event</h1>
                </div>
            </div>
        </section>
            
    </header> 