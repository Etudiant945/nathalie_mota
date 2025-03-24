<?php get_header(); ?>

<body <?php body_class(); ?> data-post-id="<?php echo get_the_ID(); ?>">
    <main class="container">
        <div class="global-container">
            <div class="info-pic">
                <ul class="info part">

                    <li>
                        <h2 class="title-pic"> <?php echo the_title(); ?></h2>
                    </li>
                    <li>
                        <p class="info-margin ref">RÉFÉRENCE : <span
                                id="reference"><?php echo get_field('reference'); ?></span>
                        </p>
                    </li>
                    <li>
                        <p class="info-margin">CATÉGORIE :
                            <?php echo get_the_terms(get_the_ID(), 'categorie')[0]->name; ?></p>
                    </li>
                    <li>
                        <p class="info-margin">FORMAT : <?php echo get_the_terms(get_the_ID(), 'format') [0]->name; ?>
                        </p>
                    </li>
                    <li>
                        <p class="info-margin">TYPE :
                            <?php 
                                  echo get_field('type-photo'); 
                               
                              
                             ?>
                        </p>
                    </li>
                    <li>
                        <p class="info-margin year">ANNÉE : <?php echo get_the_date('Y'); ?></p>
                    </li>

                </ul>
                <div>
                    <?php
                        if (have_posts()) :
                         while (have_posts()) : the_post();
                       ?>
                    <article class="single-article">
                        <div class="single-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                        <div class="single-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                </div>
                <?php
                  endwhile;
                  endif;
                  ?>
            </div>
            <!-- Interesser + CTA -->

            <div class="is-interested">
                <div class="is-interested-text-button">
                    <p class="is-interested-text">Cette photo vous intéresse ?</p>
                    <button class="is-interested-button open-contact-modal"
                        data-ref="<?php echo esc_attr(get_field('reference')); ?>">Contact</button>
                </div>


                <div class="is-interested-slider">
                    <?php
		                $previousPhoto = get_previous_post();
		                $nextPhoto = get_next_post();
		            ?>

                    <div class="is-interested-arrows">
                        <?php if (!empty($previousPhoto)) {
				            $previousThumbnail = get_the_post_thumbnail_url($previousPhoto->ID);
				            $previousLink = get_permalink($previousPhoto); ?>
                        <a href="<?php echo $previousLink; ?>">
                            <img class="arrow arrow_left"
                                src="<?php echo get_template_directory_uri(); ?>/images/Arrow_left.jpg"
                                alt="Flèche vers la gauche" />
                        </a>
                        <?php } else { ?>
                        <img style="opacity:0; cursor: auto;"
                            src="<?php echo get_template_directory_uri(); ?>/images/Arrow_left.jpg"
                            alt="Flèche vers la gauche" />
                        <?php }
			                if (!empty($nextPhoto)) {
				            $nextThumbnail = get_the_post_thumbnail_url($nextPhoto->ID);
				            $nextLink = get_permalink($nextPhoto); ?>
                        <a href="<?php echo $nextLink; ?>">
                            <img class="arrow arrow_right"
                                src="<?php echo get_template_directory_uri(); ?>/images/Arrow_right.jpg"
                                alt="Flèche vers la droite" />
                        </a>
                        <?php } else { ?>
                        <img style="opacity:0; cursor: auto;"
                            src="<?php echo get_template_directory_uri(); ?>/images/Arrow_right.jpg"
                            alt="Flèche vers la droite" />
                        <?php } ?>
                    </div>
                    <div class="img-container">
                        <div>
                            <?php if (isset($previousThumbnail) && !empty($previousThumbnail)) { ?>
                            <a href="<?php echo $previousLink; ?>">
                                <img class="previous-img" src="<?php echo $previousThumbnail; ?>"
                                    alt="afficher la photo précédente" />
                            </a>
                            <?php } else { ?>
                            <p></p>
                            <?php } ?>
                        </div>

                        <div>
                            <?php if (isset($nextThumbnail) && !empty($nextThumbnail)) { ?>
                            <a href="<?php echo $nextLink; ?>">
                                <img class="next-img" src="<?php echo $nextThumbnail; ?>"
                                    alt="afficher la photo suivante" />
                            </a>
                            <?php } else { ?>
                            <p></p>
                            <?php } ?>
                        </div>
                    </div>

                </div>

            </div>
             <!-- Photos apparentées -->

             <div class="gallery">
    <h3 class="you-may-also-like">VOUS AIMEREZ AUSSI</h3>
    <div class="gallery-container">
  <?php
  $categories = get_the_terms(get_the_ID(), 'categorie');
  $categorie_slug = $categories && !is_wp_error($categories) ? $categories[0]->slug : '';

  $page = (get_query_var('page')) ? get_query_var('page') : 1;

  $morePics = new WP_Query(array(
    'post_type' => 'photo',
    'post__not_in' => array(get_the_ID()),
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 2,
    'paged' => $page,
    'tax_query' => array(
      array(
        'taxonomy' => 'categorie',
        'field' => 'slug',
        'terms' => $categorie_slug,
      ),
    ),
  ));

  if ($morePics->have_posts()) {
    while ($morePics->have_posts()) : $morePics->the_post();

      $categories = get_the_terms(get_the_ID(), 'categorie');
      $category_name = $categories && !is_wp_error($categories) ? $categories[0]->name : '';
      ?>
      
      <div class="gallery-item">
  <div class="gallery-figure">
    <?php
    $categories = get_the_terms(get_the_ID(), 'categorie');
    $category_name = $categories[0]->name ?? '';
    the_post_thumbnail('large', [
      'alt' => get_the_title(),
      'data-category' => esc_attr($category_name),
    ]);
    ?>
    
    <div class="overlay">
      <p><?php the_title(); ?></p>
      <p><?php echo esc_html($category_name); ?></p>
    </div>

    <a href="#" class="icon-link enlarge-photo">
      <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/Icon_zoom.png" alt="Zoom" class="icon">
    </a>
    <!-- Icône œil (voir photo) -->
  <a href="<?php the_permalink(); ?>" class="icon-link view-photo">
    <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/Icon_eye.png" alt="Voir la photo" class="icon">
  </a>
  </div>
</div>

    <?php
    endwhile;
  } else {
    echo '<p>Il n\'y a pas d\'autres photos dans cette catégorie.</p>';
  }

  wp_reset_postdata();
  ?>
</div>
</div>





        </div>
        <div id="image-modal" class="image-modal">
  <span class="close-modal">&times;</span>
  <span class="modal-arrow modal-prev">
  &#8592; <!-- fleche gauche -->
  <p class="arrow"> Précédente </p>
</span>
<span class="modal-arrow modal-next">
<p class="arrow"> Suivante </p>
&#8594; <!-- fleche droite -->
</span>
  <img id="modal-image" alt="Photo agrandie">
  <div class="modal-caption">
    <p class="caption-left reference-text"></p>
    <p class="caption-right category-text"></p>
  </div>
</div>

    </main>
    <?php get_footer(); ?>