<footer>
    <div class="footer-bar"></div> <!-- La barre noire -->
    <div class="container">
        <nav>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu', // Emplacement du menu
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