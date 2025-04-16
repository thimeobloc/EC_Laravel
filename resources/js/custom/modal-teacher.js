document.addEventListener('DOMContentLoaded', function () {
    const modalTeachers = document.querySelectorAll('.table-with-modal');

    modalTeachers.forEach(function (table) {
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
                        if (data.status === 'success' && data.teacher) {
                            fillModalForm(data.teacher);
                            const modal = KTModal.getInstance(modalEl);
                            modal.show();
                        } else {
                            console.error('Erreur : enseignant non trouvé');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur AJAX :', error);
                    });
            }
        });
    });

    function fillModalForm(teacher) {
        document.getElementById('teacher_id').value = teacher.id;
        document.getElementById('teacher_first_name').value = teacher.first_name || '';
        document.getElementById('teacher_last_name').value = teacher.last_name || '';
        document.getElementById('teacher_email').value = teacher.email || '';
        document.getElementById('teacher_birth_date').value = teacher.birth_date || '';
    }

    const updateButton = document.getElementById('update-teacher');
    if (updateButton) {
        updateButton.addEventListener('click', function () {
            const id = document.getElementById('teacher_id').value;

            const formData = {
                first_name: document.getElementById('teacher_first_name').value,
                last_name: document.getElementById('teacher_last_name').value,
                email: document.getElementById('teacher_email').value,
                birth_date: document.getElementById('teacher_birth_date').value
            };

            fetch(`/teachers/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const modal = KTModal.getInstance(document.getElementById('teacher-modal'));
                        modal.hide();
                        location.reload();
                    } else {
                        console.error('Échec de la mise à jour de l’enseignant');
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la mise à jour :', error);
                });
        });
    }
});
