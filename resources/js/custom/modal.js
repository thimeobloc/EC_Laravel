document.addEventListener('DOMContentLoaded', function () {
    // Select all tables with modal functionality
    const modalTables = document.querySelectorAll('.table-with-modal');

    // Loop through each table to add a click event listener
    modalTables.forEach(function (table) {
        table.addEventListener('click', function (event) {
            const target = event.target;

            // Check if the clicked element is a button
            if (target.classList.contains('btn')) {
                const route = target.getAttribute('data-route');
                const modalSelector = target.getAttribute('data-modal');
                const modalEl = document.querySelector(modalSelector);

                // If modal element doesn't exist, log an error
                if (!modalEl) {
                    console.error(`Le modal ${modalSelector} est introuvable.`);
                    return;
                }

                // Fetch data from the route URL
                fetch(route)
                    .then(response => response.json())
                    .then(data => {
                        // If the response is successful, fill the modal form
                        if (data.status === 'success' && data.user) {
                            fillModalForm(data.user);
                            const modal = KTModal.getInstance(modalEl);
                            modal.show();
                        } else {
                            console.error('Erreur : utilisateur non trouvé');
                        }
                    })
                    .catch(error => {
                        // Handle any AJAX errors
                        console.error('Erreur AJAX :', error);
                    });
            }
        });
    });

    // Function to fill the modal form with the received user data
    function fillModalForm(user) {
        document.getElementById('student_id').value = user.id;
        document.getElementById('first_name').value = user.first_name || '';
        document.getElementById('last_name').value = user.last_name || '';
        document.getElementById('email').value = user.email || '';
        document.getElementById('birth_date').value = user.birth_date || '';
    }

    // Submit the form via AJAX (PUT request)
    const updateButton = document.getElementById('update-student');
    if (updateButton) {
        updateButton.addEventListener('click', function () {
            const id = document.getElementById('student_id').value;
            console.log(id)

            // Gather the form data
            const formData = {
                first_name: document.getElementById('first_name').value,
                last_name: document.getElementById('last_name').value,
                email: document.getElementById('email').value,
                birth_date: document.getElementById('birth_date').value
            };

            // Send the form data via AJAX (POST method)
            fetch(`/students/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData) // ✅ Here we use formData
            })
                .then(response => response.json())
                .then(data => {
                    // If successful, close the modal and reload the page
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
                    // Handle errors during the update process
                    console.error('Erreur lors de la mise à jour :', error);
                });
        });
    }

});
