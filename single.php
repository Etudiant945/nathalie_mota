<?php get_header(); ?>
<body <?php body_class(); ?> data-post-id="<?php echo get_the_ID(); ?>">
<main class="container">
  <div class="global-container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <!-- Image principale -->         
      <?php get_template_part('templates_part/single-principal'); ?>
       
      <!-- Galerie suggérée -->      
      <?php get_template_part('templates_part/single-gallery'); ?>

      <!-- Modale d'image -->
      <div id="image-modal" class="image-modal">
        <span class="close-modal">&times;</span>
        <span class="modal-arrow modal-prev">&#8592;<p class="arrow"> Précédente </p></span>
        <span class="modal-arrow modal-next"><p class="arrow"> Suivante </p>&#8594;</span>
        <img id="modal-image" alt="Photo agrandie">
        <div class="modal-caption">
          <p class="caption-left reference-text"></p>
          <p class="caption-right category-text"></p>
        </div>
      </div>

    <?php endwhile; endif; ?>

  </div>
</main>
<?php get_footer(); ?>