// modal  pour le contact 

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contactModal'); // Cible la modale
    const openModalBtns = document.querySelectorAll('.open-contact-modal'); // Cible les boutons "Contact"
    const photoRefInput = document.getElementById('your-subject'); // Cible le champ "REF. PHOTO" du formulaire

    // Ajouter un événement sur chaque bouton de "Contact"
    openModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const photoRef = btn.getAttribute('data-ref'); // Récupère la référence via l'attribut data-ref
            console.log('Référence récupérée :', photoRef); // Vérifie dans la console du navigateur

            if (photoRefInput && photoRef) {
                photoRefInput.value = photoRef; // Mettre à jour le champ "REF. PHOTO" avec la référence
            }
            modal.style.display = 'block'; // Affiche la modale
        });
    });

    // Fermer la modale si l'utilisateur clique en dehors de la fenêtre
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none'; // Cache la modale si l'on clique en dehors
        }
    });
});


// modal pour la page d'accueil
jQuery(document).ready(function($) {
  console.log("modal.js chargé");

  let currentIndex = 0;
  let items = [];

  // Clic sur l’icône de zoom
  $(document).on('click', '.enlarge-photo', function(e) {
      e.preventDefault();  // Empêche la redirection par défaut
      console.log("Clique sur l'icône de zoom");

      items = $('.article-item'); // Récupère tous les articles
      currentIndex = items.index($(this).closest('.article-item'));

      updateModalContent(currentIndex);
      $('#image-modal').fadeIn();
  });

  // Fonction pour mettre à jour le contenu de la modale
  function updateModalContent(index) {
      const item = items.eq(index);
      const imageSrc = item.find('.article-image img').attr('src');
      const reference = item.find('.reference').text();
      const categorie = item.find('.categories').text();

      $('#modal-image').attr('src', imageSrc);
      $('#reference-text').text(reference);
      $('#category-text').text(categorie);
  }

  // Fermer la modale lorsqu'on clique sur la croix
  $(document).on('click', '.close-modal', function() {
      $('#image-modal').fadeOut();
  });

  // Fermer la modale si on clique en dehors de l'image (sur le fond)
  $(window).on('click', function(event) {
      if ($(event.target).is('#image-modal')) {
          $('#image-modal').fadeOut();
      }
  });

  // Flèche droite → image suivante
  $(document).on('click', '.modal-next', function() {
      if (items.length === 0) return;
      currentIndex = (currentIndex + 1) % items.length;
      updateModalContent(currentIndex);
  });

  // Flèche gauche ← image précédente
  $(document).on('click', '.modal-prev', function() {
      if (items.length === 0) return;
      currentIndex = (currentIndex - 1 + items.length) % items.length;
      updateModalContent(currentIndex);
  });
});

// Modal single page
jQuery(document).ready(function($) {
  const $modal = $('#image-modal');
  const $modalImg = $('#modal-image');
  let items = [];
  let currentIndex = 0;

  // Met à jour le contenu de la modale
  function updateModalContent(index) {
    const $img = $(items[index]);
    const imgSrc = $img.attr('src');
    const reference = $img.attr('alt') || 'Photo';
    const category = $img.data('category') || '';

    $modalImg.attr('src', imgSrc);
    $modal.find('.reference-text').text(reference);
    $modal.find('.category-text').text(category);
  }

  // Ouvre la modale depuis un conteneur d’image
  function openModalFromContainer($container) {
    const $img = $container.find('img[data-category]');
    const imgSrc = $img.attr('src');
    const reference = $img.attr('alt') || 'Photo';
    const category = $img.data('category') || '';

    // Injection des infos dans la modale
    $modalImg.attr('src', imgSrc);
    $modal.find('.reference-text').text(reference);
    $modal.find('.category-text').text(category);
    $modal.fadeIn(200);

    // Initialise les images et l’index courant
    items = $('img[data-category]').toArray();
    currentIndex = items.findIndex(img => $(img).attr('src') === imgSrc);
  }

  // Clic sur l’image principale
  $('.gallery-figure img[data-category]').on('click', function(e) {
    e.preventDefault();
    const $container = $(this).closest('.gallery-figure');
    openModalFromContainer($container);
  });

  // Clic sur l’icône de zoom
  $('.enlarge-photo').on('click', function(e) {
    e.preventDefault();
    const $container = $(this).closest('.gallery-figure');
    openModalFromContainer($container);
  });

  // Fermer la modale avec la croix
  $('.close-modal').on('click', function() {
    $modal.fadeOut(200, function() {
      $modalImg.attr('src', '');
      $modal.find('.reference-text').text('');
      $modal.find('.category-text').text('');
      items = [];
      currentIndex = 0;
    });
  });

  // Fermer la modale en cliquant à côté de l’image
  $(window).on('click', function(e) {
    if ($(e.target).is('#image-modal')) {
      $modal.fadeOut(200, function() {
        $modalImg.attr('src', '');
        $modal.find('.reference-text').text('');
        $modal.find('.category-text').text('');
        items = [];
        currentIndex = 0;
      });
    }
  });

  // Flèche droite → image suivante
  $(document).on('click', '.modal-next', function() {
    if (items.length === 0) return;
    currentIndex = (currentIndex + 1) % items.length;
    updateModalContent(currentIndex);
  });

  // Flèche gauche ← image précédente
  $(document).on('click', '.modal-prev', function() {
    if (items.length === 0) return;
    currentIndex = (currentIndex - 1 + items.length) % items.length;
    updateModalContent(currentIndex);
  });
});
