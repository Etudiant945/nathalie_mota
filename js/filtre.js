jQuery(document).ready(function($) {
    var page = 1; // Page initiale

    function loadArticles(loadMore = false) {
        var data = {
            action: 'load_more_photos',
            page: page,
            categorie: $('#categories').val(),
            format: $('#formats').val(),
            sort: $('#sort-by-date').val(),
        };

        $.ajax({
            url: ajaxurl,
            type: 'GET',
            data: data,
            success: function(response) {
                if (response.trim() !== '') {
                    if (loadMore) {
                        $('#article-list').append(response);
                    } else {
                        $('#article-list').html(response);
                    }
                    attachClickEvent(); // Attacher les événements aux nouvelles images
                } else {
                    $('#load-more').hide();
                }
            },
            error: function() {
                alert('Une erreur est survenue. Essayez de nouveau.');
            }
        });
    }

    // Événements sur les filtres
    $('#categories, #formats, #sort-by-date').on('change', function() {
        page = 1;
        loadArticles();
        $('#load-more').show();
    });

    // Nouvelle fonction pour gérer le clic sur le conteneur de l'image
    function attachClickEvent() {
        // Détacher d'abord les événements précédents pour éviter les doublons
        $('.article-image').off('click').on('click', function(e) {
            // Si l'élément cliqué ou un de ses parents possède la classe "enlarge-photo", ne rien faire
            if ($(e.target).closest('.enlarge-photo').length > 0) {
                return;
            }
            // Sinon, récupérer l'URL associée à l'article et rediriger
            var postUrl = $(this).closest('.article-item').attr('data-url');
            if (postUrl) {
                window.location.href = postUrl;
            }
        });
    }

    // Charger plus d'articles
    $('#load-more').on('click', function() {
        page++;
        loadArticles(true);
    });

    // Charger les articles dès le début
    loadArticles();
});
