document.addEventListener("DOMContentLoaded", function() {
    const formElements = document.querySelectorAll('.filters-container select');

    formElements.forEach(function(selectElement) {
        selectElement.addEventListener('change', function() {
            const form = this.form;
            const url = new URL(window.location.href);

            // Parcours des éléments de formulaire
            const formData = new FormData(form);
            formData.forEach(function(value, key) {
                url.searchParams.set(key, value);
            });

            // Rediriger l'utilisateur vers la nouvelle URL avec les paramètres de filtre
            window.location.href = url;
        });
    });
});
