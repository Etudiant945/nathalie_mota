 <!-- Galerie suggérée -->
 <div class="gallery">
     <h3 class="you-may-also-like">VOUS AIMEREZ AUSSI</h3>
     <div class="gallery-container">
         <?php
              $categories = get_the_terms(get_the_ID(), 'categorie');
              $categorie_slug = $categories && !is_wp_error($categories) ? $categories[0]->slug : '';

              $morePics = new WP_Query([
                'post_type' => 'photo',
                'post__not_in' => [get_the_ID()],
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => 2,
                'tax_query' => [[
                  'taxonomy' => 'categorie',
                  'field' => 'slug',
                  'terms' => $categorie_slug,
                ]],
              ]);
              if ($morePics->have_posts()) :
                while ($morePics->have_posts()) : $morePics->the_post();
                  $categories = get_the_terms(get_the_ID(), 'categorie');
                  $category_name = $categories[0]->name ?? '';
            ?>
         <div class="gallery-item">
             <div class="gallery-figure">
                 <?php echo wp_get_attachment_image(
                    get_post_thumbnail_id(),
                    'large',
                    false,
                    [
                      'alt' => get_the_title(),
                      'data-category' => esc_attr($category_name),
                    ]
                  ); ?>
                 <div class="overlay">
                     <p><?php the_title(); ?></p>
                     <p><?php echo esc_html($category_name); ?></p>
                 </div>
                 <a href="#" class="icon-link enlarge-photo">
                     <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/Icon_zoom.png" alt="Zoom"
                         class="icon">
                 </a>
                 <a href="<?php the_permalink(); ?>" class="icon-link view-photo">
                     <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/Icon_eye.png"
                         alt="Voir la photo" class="icon">
                 </a>
             </div>
         </div>
         <?php endwhile; else : ?>
         <p>Il n'y a pas d'autres photos dans cette catégorie.</p>
         <?php endif; wp_reset_postdata(); ?>
     </div>
 </div>