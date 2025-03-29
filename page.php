<!-- pour pouvoir afficher les autres pages -->

<?php get_header(); ?>

<main id="main" class="site-main">
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      the_title( '<h1>', '</h1>' );
      the_content();
    endwhile;
  else :
    echo '<p>Aucun contenu trouvé.</p>';
  endif;
  ?>
</main>

<?php get_footer(); ?>