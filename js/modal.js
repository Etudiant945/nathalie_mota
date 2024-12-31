document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contactModal');
    // const closeBtn = modal.querySelector('.close-btn');
    const openModalBtns = document.querySelectorAll('.open-contact-modal');

    openModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            modal.style.display = 'block'; // Affiche la modale
        });
    });

    // closeBtn.addEventListener('click', () => {
    //     modal.style.display = 'none'; // Cache la modale
    // });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none'; // Cache la modale si clic à l'extérieur
        }
    });
});