document.addEventListener('DOMContentLoaded', function () {
    const modalTables = document.querySelectorAll('.table-with-modal');

    modalTables.forEach(function (table) {
        table.addEventListener('click', function (event) {
            const target = event.target;

            if (target.classList.contains('btn')) {
                const route = target.getAttribute('data-route');
                const modalSelector = target.getAttribute('data-modal');
                const modalEl = document.querySelector(modalSelector);

                if (!modalEl) {
                    console.error(`Le modal ${modalSelector} est introuvable.`);
                    return;
                }

                fetch(route)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success' && data.user) {
                            fillModalForm(data.user);
                            const modal = KTModal.getInstance(modalEl);
                            modal.show();
                        } else {
                            console.error('Erreur : utilisateur non trouvé');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur AJAX :', error);
                    });
            }
        });
    });

    function fillModalForm(user) {
        document.getElementById('student_id').value = user.id ?? '';
        document.getElementById('last_name').value = user.last_name ?? '';
        document.getElementById('first_name').value = user.first_name ?? '';
        document.getElementById('birth_date').value = user.birth_date ?? '';
        document.getElementById('email').value = user.email ?? '';
    }
});
