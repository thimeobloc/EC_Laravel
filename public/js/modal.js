document.addEventListener("DOMContentLoaded", function () {
    // Affichage de la modal
    document.querySelectorAll('[data-modal-toggle]').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault(); // Empêche le comportement par défaut
            const modalId = button.getAttribute('data-modal-toggle');
            const modal = document.querySelector(modalId);
            if (modal) {
                modal.style.display = 'block'; // Afficher la modal
            }
        });
    });

    // Fermeture de la modal
    document.querySelectorAll('[data-modal-close]').forEach(closeButton => {
        closeButton.addEventListener('click', (e) => {
            const modal = closeButton.closest('.modal');
            if (modal) {
                modal.style.display = 'none'; // Fermer la modal
            }
        });
    });
});
