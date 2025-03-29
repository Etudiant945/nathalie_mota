
jQuery(document).ready(function($) {
    console.log("lightbox.js chargé");
  
    let currentIndex = 0;
    let items = [];
  
    $(document).on('click', '.enlarge-photo', function(e) {
        e.preventDefault();
        items = $('.article-item');
        currentIndex = items.index($(this).closest('.article-item'));
        updateModalContent(currentIndex);
        $('#image-modal').fadeIn();
    });
  
    function updateModalContent(index) {
        const item = items.eq(index);
        const imageSrc = item.find('.article-image img').attr('src');
        const reference = item.find('.reference').text();
        const categorie = item.find('.categories').text();
  
        $('#modal-image').attr('src', imageSrc);
        $('#reference-text').text(reference);
        $('#category-text').text(categorie);
    }
  
    $(document).on('click', '.close-modal', function() {
        $('#image-modal').fadeOut();
    });
  
    $(window).on('click', function(event) {
        if ($(event.target).is('#image-modal')) {
            $('#image-modal').fadeOut();
        }
    });
  
    $(document).on('click', '.modal-next', function() {
        if (items.length === 0) return;
        currentIndex = (currentIndex + 1) % items.length;
        updateModalContent(currentIndex);
    });
  
    $(document).on('click', '.modal-prev', function() {
        if (items.length === 0) return;
        currentIndex = (currentIndex - 1 + items.length) % items.length;
        updateModalContent(currentIndex);
    });
  });
  