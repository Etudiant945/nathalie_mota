<?php get_header(); ?>

<section class="hero-section">
    <div class="hero-image">
        <?php 
        // Inclure le fichier contenant le tableau des images
       // include(get_template_directory() . '/templates_part/image-array.php'); // Modifie le chemin ici

        // Choisir une image aléatoire à partir du tableau
      //  $random_image = $hero_images[array_rand($hero_images)]; 
      $query = new WP_Query(
        array(
            'post_type' => 'photo',
            'posts_per_page' => 1,
            'orderby' => 'rand', 
        )
        );
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        $random_image = get_field('photo'); 
        ?>

        <img src="<?php echo esc_url($random_image); ?>" alt="Image aléatoire de photographe" class="hero-img">

        <div class="hero-overlay">
            <h1 class="hero-title">Photographe event</h1>
        </div>
    </div>
    <?php endwhile; endif; ?>
</section>


<section class="container filters-and-posts-container">
    <div class="filters-container">
        <div class="category-format-filters">
            <!-- Filter Categories -->
            <div class="categories-filter">
                <form class="filter-column" id="category-filter">
                    <select id="categories" name="categorie" class="filters-container__photo-filter">
                        <option value="all" hidden></option>
                        <option value="all" selected>CATÉGORIES</option>
                        <?php
                        $categories = get_terms(array(
                            "taxonomy" => "categorie", 
                            "hide_empty" => false,
                        ));
                        foreach ($categories as $categorie) {
                            echo '<option value="' . $categorie->slug . '" ' . (isset($_GET['categorie']) && $_GET['categorie'] == $categorie->slug ? 'selected' : '') . '>' . mb_convert_case($categorie->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                    </select>
                </form>
                <button type="button" class="filters-container__photo-filter__arrow">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/arrow-down.png" alt="flèche vers le bas">
                </button>
            </div>

            <!-- Filter Formats -->
            <div class="formats-filter">
                <form class="filter-column" id="format-filter">
                    <select id="formats" name="format" class="filters-container__photo-filter">
                        <option value="all" hidden></option>
                        <option value="all" selected>FORMATS</option>
                        <?php
                        $formats = get_terms(array(
                            "taxonomy" => "format", 
                            "hide_empty" => false,
                        ));
                        foreach ($formats as $format) {
                            echo '<option value="' . $format->slug . '" ' . (isset($_GET['format']) && $_GET['format'] == $format->slug ? 'selected' : '') . '>' . mb_convert_case($format->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                    </select>
                </form>
                <button type="button" class="filters-container__photo-filter__arrow">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/arrow-down.png" alt="flèche vers le bas">
                </button>
            </div>
        </div>

        <!-- Filter Sort By Date -->
        <div class="sort-by-date-filter">
            <form class="filter-column" id="sort-filter">
                <select id="sort-by-date" name="sort" class="filters-container__photo-filter">
                    <option value="all" hidden></option>
                    <option value="all" selected>TRIER PAR</option>
                    <option value="DESC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'DESC') ? 'selected' : ''; ?>>Les Plus Récentes</option>
                    <option value="ASC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ASC') ? 'selected' : ''; ?>>Les Plus Anciennes</option>
                </select>
                <button type="button" class="filters-container__photo-filter__arrow">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/buttons/arrow-down.png" alt="flèche vers le bas">
                </button>
            </form>
        </div>
    </div>
    
</section>


<section class="container article-list" id="article-list"> 
    <!-- Les articles vont être chargés ici dynamiquement via AJAX -->
</section>

<!-- Modale pour afficher l'image agrandie -->

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
    <p id="reference-text" class="caption-left"></p>
    <p id="category-text" class="caption-right"></p>
  </div>
</div>


                            
<button id="load-more" class="container filters-and-posts-container load-more-btn">Charger plus</button>


<?php get_footer(); ?> 