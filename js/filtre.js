jQuery(document).ready(function($) {
    var page = 1; // Page initiale

    // Lors du clic sur "Charger plus"
    $('#load-more').on('click', function() {
        page++; // Augmente la page pour charger les photos suivantes
        
        var data = {
            action: 'load_more_photos', // Action à appeler
            page: page, // Page à charger
            categorie: $('#categories').val(), // Paramètre catégorie
            format: $('#formats').val(), // Paramètre format
            sort: $('#sort-by-date').val(), // Paramètre tri
        };
        
        // Requête Ajax
        $.ajax({
            url: ajaxurl, // URL d'Ajax dans WordPress
            type: 'GET',
            data: data,
            success: function(response) {
                if(response) {
                    $('#article-list').append(response); // Ajouter les articles à la page
                } else {
                    $('#load-more').hide(); // Cacher le bouton si aucune photo supplémentaire
                }
                // Cacher le bouton "Charger plus" après avoir cliqué dessus
                $('#load-more').hide();
            },
            error: function() {
                alert('Une erreur est survenue. Essayez de nouveau.');
            }
        });
    });
});
