<div class="info-pic">
    <ul class="info part">
        <li>
            <h2 class="title-pic"><?php the_title(); ?></h2>
        </li>
        <li>
            <p class="info-margin ref">RÉFÉRENCE : <span id="reference"><?php the_field('reference'); ?></span></p>
        </li>
        <li>
            <p class="info-margin">CATÉGORIE : <?php echo get_the_terms(get_the_ID(), 'categorie')[0]->name; ?></p>
        </li>
        <li>
            <p class="info-margin">FORMAT : <?php echo get_the_terms(get_the_ID(), 'format')[0]->name; ?></p>
        </li>
        <li>
            <p class="info-margin">TYPE : <?php the_field('type-photo'); ?></p>
        </li>
        <li>
            <p class="info-margin year">ANNÉE : <?php echo get_the_date('Y'); ?></p>
        </li>
    </ul>

    <div class="single-article-box">
        <article class="single-article">
            <div class="single-image">
                <?php the_post_thumbnail('large'); ?>
            </div>
            <div class="single-content">
                <?php the_content(); ?>
            </div>
        </article>
    </div>
</div>

<!-- Section intérêt + navigation fléchée -->
<div class="is-interested">
    <div class="is-interested-text-button">
        <p class="is-interested-text">Cette photo vous intéresse ?</p>
        <button class="is-interested-button open-contact-modal"
            data-ref="<?php echo esc_attr(get_field('reference')); ?>">Contact</button>
    </div>

    <?php $previousPhoto = get_previous_post(); $nextPhoto = get_next_post(); ?>
    <div class="is-interested-slider">
        <div class="is-interested-arrows">
            <?php if ($previousPhoto) : ?>
            <a href="<?php echo get_permalink($previousPhoto); ?>">
                <img class="arrow arrow_left" src="<?php echo get_template_directory_uri(); ?>/images/buttons/Arrow_left.jpg" alt="Flèche gauche" />
            </a>
            <?php else : ?>
            <img style="opacity:0; cursor: auto;"
                src="<?php echo get_template_directory_uri(); ?>/images/buttons/Arrow_left.jpg" alt="Flèche gauche" />
            <?php endif; ?>

            <?php if ($nextPhoto) : ?>
            <a href="<?php echo get_permalink($nextPhoto); ?>">
                <img class="arrow arrow_right" src="<?php echo get_template_directory_uri(); ?>/images/buttons/Arrow_right.jpg" alt="Flèche droite" />
            </a>
            <?php else : ?>
            <img style="opacity:0; cursor: auto;"
                src="<?php echo get_template_directory_uri(); ?>/images/buttons/Arrow_right.jpg" alt="Flèche droite" />
            <?php endif; ?>
        </div>

        <div class="img-container">
            <div>
                <?php if ($previousPhoto) : ?>
                <a href="<?php echo get_permalink($previousPhoto); ?>">
                    <img class="previous-img" src="<?php echo get_the_post_thumbnail_url($previousPhoto->ID); ?>"
                        alt="Photo précédente" />
                </a>
                <?php endif; ?>
            </div>
            <div>
                <?php if ($nextPhoto) : ?>
                <a href="<?php echo get_permalink($nextPhoto); ?>">
                    <img class="next-img" src="<?php echo get_the_post_thumbnail_url($nextPhoto->ID); ?>"
                        alt="Photo suivante" />
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>