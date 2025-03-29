<?php get_header(); ?>


<main>
    <!-- Hero Section -->
    <?php get_template_part('templates_part/hero'); ?>

    <!-- Filtres + Liste d’articles -->
    <section class="container filters-and-posts-container">
        <?php get_template_part('templates_part/filters'); ?>
    </section>

    <!-- Liste des articles (chargés dynamiquement via AJAX) -->
    <section class="container article-list" id="article-list">
    </section>

    <!-- Modale image -->
    <div id="image-modal" class="image-modal">
        <span class="close-modal">&times;</span>
        <span class="modal-arrow modal-prev">
            &#8592;
            <!-- fleche gauche -->
            <p class="arrow"> Précédente </p>
        </span>
        <span class="modal-arrow modal-next">
            <p class="arrow"> Suivante </p>
            &#8594;
            <!-- fleche droite -->
        </span>
        <img id="modal-image" alt="Photo agrandie">
        <div class="modal-caption">
            <p id="reference-text" class="caption-left"></p>
            <p id="category-text" class="caption-right"></p>
        </div>
    </div>

    <!-- Bouton charger plus -->
    <button id="load-more" class="container filters-and-posts-container load-more-btn">Charger plus</button>


</main>
<?php get_footer(); ?>