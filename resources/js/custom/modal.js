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

    // Remplir les champs du modal avec les données reçues
    function fillModalForm(user) {
        document.getElementById('student_id').value = user.id;
        document.getElementById('first_name').value = user.first_name || '';
        document.getElementById('last_name').value = user.last_name || '';
        document.getElementById('email').value = user.email || '';
        document.getElementById('birth_date').value = user.birth_date || '';
    }

    // Soumission du formulaire via AJAX (PUT)
    const updateButton = document.getElementById('update-student');
    if (updateButton) {
        updateButton.addEventListener('click', function () {
            const id = document.getElementById('student_id').value;
            console.log(id)

            const formData = {
                first_name: document.getElementById('first_name').value,
                last_name: document.getElementById('last_name').value,
                email: document.getElementById('email').value,
                birth_date: document.getElementById('birth_date').value
            };

            fetch(`/students/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData) // ✅ Ici on utilise formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        console.log('Étudiant mis à jour avec succès');
                        const modal = KTModal.getInstance(document.getElementById('student-modal'));
                        modal.hide();
                        location.reload();
                    } else {
                        console.error('Échec de la mise à jour de l’étudiant');
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la mise à jour :', error);
                });
        });
    }

});
