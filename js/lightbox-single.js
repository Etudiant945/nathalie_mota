
jQuery(document).ready(function($) {
  const $modal = $('#image-modal');
  const $modalImg = $('#modal-image');
  let items = [];
  let currentIndex = 0;

  function updateModalContent(index) {
    const $img = $(items[index]);
    const imgSrc = $img.attr('src');
    const reference = $img.attr('alt') || 'Photo';
    const category = $img.data('category') || '';

    $modalImg.attr('src', imgSrc);
    $modal.find('.reference-text').text(reference);
    $modal.find('.category-text').text(category);
  }

  function openModalFromContainer($container) {
    const $img = $container.find('img[data-category]');
    const imgSrc = $img.attr('src');
    const reference = $img.attr('alt') || 'Photo';
    const category = $img.data('category') || '';

    $modalImg.attr('src', imgSrc);
    $modal.find('.reference-text').text(reference);
    $modal.find('.category-text').text(category);
    $modal.fadeIn(200);

    items = $('img[data-category]').toArray();
    currentIndex = items.findIndex(img => $(img).attr('src') === imgSrc);
  }

  $('.gallery-figure img[data-category]').on('click', function(e) {
    e.preventDefault();
    openModalFromContainer($(this).closest('.gallery-figure'));
  });

  $('.enlarge-photo').on('click', function(e) {
    e.preventDefault();
    openModalFromContainer($(this).closest('.gallery-figure'));
  });

  $('.close-modal').on('click', function() {
    closeModal();
  });

  $(window).on('click', function(e) {
    if ($(e.target).is('#image-modal')) {
      closeModal();
    }
  });

  function closeModal() {
    $modal.fadeOut(200, function() {
      $modalImg.attr('src', '');
      $modal.find('.reference-text').text('');
      $modal.find('.category-text').text('');
      items = [];
      currentIndex = 0;
    });
  }

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
