<footer>
    <div class="footer-bar"></div>
    <div class="container">
        <nav>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'menu_class'     => 'footer-menu-list', 
                'container'      => 'ul', 
            ));
            ?>
        </nav>
    </div>
    <?php get_template_part('templates_part/contact_modal'); ?>   
</footer>
<?php wp_footer(); ?>
</body>
</html>