<footer>
    <div class="container">
    <nav>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer-menu', // Remplacez par l'emplacement si vous utilisez un emplacement spécifique
            'menu_class'     => 'footer-menu-list', // Classe CSS pour styliser votre menu
            'container'      => 'ul', // Évitez d'utiliser un conteneur inutile
        ));
        ?>
    </nav>
    </div>
    <?php get_template_part('templates_part/contact_modal'); ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>