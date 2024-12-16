<?php get_header(); ?>

<main>
    <section class="content">
        <?php
        // La boucle WordPress (WordPress Loop) pour afficher les articles
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article>
                    <h2><?php the_title(); ?></h2>
                    <div><?php the_content(); ?></div>
                </article>
                <?php
            endwhile;
        else :
            echo '<p>Aucun contenu trouvé.</p>';
        endif;
        ?>
    </section>
</main>

<?php get_footer(); ?>