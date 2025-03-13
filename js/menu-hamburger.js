
document.addEventListener("DOMContentLoaded", function() {
    console.log("Document chargé !");
    
    const menuToggle = document.querySelector(".menu-toggle");
    const menu = document.querySelector(".menu-header");

    if (!menuToggle || !menu) {
        console.error("Les éléments menuToggle ou menu sont introuvables !");
        return;
    }

    menuToggle.addEventListener("click", function() {
        console.log("Hamburger cliqué !");
        menu.classList.toggle("active");
        menuToggle.classList.toggle("active"); // Ajoute aussi la classe au bouton
        console.log("Classe active ajoutée ?", menu.classList.contains("active"));
    });
});