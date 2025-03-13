jQuery(document).ready(function($) {
    // Votre code ici, en utilisant $ à l'intérieur de cette fonction

    jQuery('.filters-container__photo-filter__arrow').on('click', function() {
        var selectElement = jQuery(this).siblings('.filters-container__photo-filter');
        
        // Si le select est déjà ouvert, on le ferme
        if (selectElement.is(':focus')) {
            selectElement.blur(); // Ferme le menu déroulant
        } else {
            selectElement.focus(); // Ouvre le menu déroulant
        }
    });
}); 

