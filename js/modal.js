document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contactModal'); // Cible la modal
    // const closeBtn = modal.querySelector('.close-btn'); // Si tu veux un bouton de fermeture
    const openModalBtns = document.querySelectorAll('.open-contact-modal'); // Cible tous les boutons pour ouvrir la modal

    // Ajoute l'événement pour chaque bouton de "Contact"
    openModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            modal.style.display = 'block'; // Affiche la modal lorsque le bouton est cliqué
        });
    });

    // Fermer la modal si l'utilisateur clique en dehors de la fenêtre
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none'; // Cache la modal si l'on clique en dehors
        }
    });

    // Si tu veux ajouter un bouton de fermeture à l'intérieur de la modal
    // closeBtn.addEventListener('click', () => {
    //     modal.style.display = 'none'; // Cache la modal si le bouton de fermeture est cliqué
    // });
});
