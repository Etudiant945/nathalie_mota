// modal  pour le contact 

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contactModal'); 
    const openModalBtns = document.querySelectorAll('.open-contact-modal'); 
    const photoRefInput = document.getElementById('your-subject'); 

    // Ajouter un événement sur chaque bouton de "Contact"
    openModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const photoRef = btn.getAttribute('data-ref'); 
            console.log('Référence récupérée :', photoRef); 

            if (photoRefInput && photoRef) {
                photoRefInput.value = photoRef; 
            }
            modal.style.display = 'block'; 
        });
    });

    // Fermer la modale si l'utilisateur clique en dehors de la fenêtre
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none'; 
        }
    });
});




