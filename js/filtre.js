jQuery(document).ready(function($) {
    let page = 1;
  
    /* INITIALISATION DES FILTRES (Select2) */
    $('#categories, #formats, #sort-by-date').select2({
      minimumResultsForSearch: Infinity
    });
  
    // Ajout d'une icône personnalisée dans chaque champ Select2
    setTimeout(() => {
      $('.select2-container--default .select2-selection--single').each(function () {
        if (!$(this).find('.custom-arrow').length) {
          $(this).append(`
            <i class="fa-solid fa-chevron-down custom-arrow" 
               style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%);
                      pointer-events: none; font-size: 12px; color: #2E2F3E;"></i>
          `);
        }
      });
    }, 100);
  
    $(document).on('select2:opening select2:closing', function(e) {
      e.stopPropagation();
    });
   
    /* CHARGEMENT DES ARTICLES (AJAX)*/
    function loadArticles(loadMore = false) {
      const data = {
        action: 'load_more_photos',
        page,
        categorie: $('#categories').val(),
        format: $('#formats').val(),
        sort: $('#sort-by-date').val(),
      };
  
      $.ajax({
        url: ajaxurl,
        type: 'GET',
        data,
        success: function(response) {
          const cleaned = response.trim();
  
          if (cleaned !== '') {
            if (loadMore) {
              $('#article-list').append(cleaned);
            } else {
              $('#article-list').html(cleaned);
            }
  
            $('#no-articles-message').remove();
            if (typeof attachClickEvent === 'function') attachClickEvent(); 
          } else {
            if (!loadMore) {
              $('#article-list').html('<p id="no-articles-message">Aucune photo trouvée.</p>');
            }
            $('#load-more').hide();
          }
        },
        error: function() {
          alert('Une erreur est survenue. Veuillez réessayer.');
        }
      });
    }
  
    /* ÉVÉNEMENTS */
  
    $('#categories, #formats, #sort-by-date').on('change', function() {
      page = 1;
      loadArticles();
      $('#load-more').show();
    });
  
    $('#load-more').on('click', function() {
      page++;
      loadArticles(true);
    });
  
    loadArticles();
  });
  