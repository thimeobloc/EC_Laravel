document.addEventListener('DOMContentLoaded', function () {
    // Select all tables with modal functionality for teachers
    const teacherModalTables = document.querySelectorAll('.teacher-table-with-modal');

    // Loop through each table to add a click event listener
    teacherModalTables.forEach(function (table) {
        table.addEventListener('click', function (event) {
            const target = event.target;

            // Check if the clicked element is a button
            if (target.classList.contains('btn')) {
                const route         = target.getAttribute('data-route');
                const modalSelector = target.getAttribute('data-modal');
                const modalEl       = document.querySelector(modalSelector);
                const modal         = KTModal.getInstance(modalEl);

                // Empty the modal body
                modalEl.querySelector('.modal-body').innerHTML = 'Chargement...';

                // If modal element doesn't exist, log an error
                if (!modalEl) {
                    console.error(`Le modal ${modalSelector} est introuvable.`);
                    return;
                }

                modal.show();

                // Fetch data from the route URL
                fetch(route)
                    .then(response => response.json())
                    .then(data => {
                        // If the response is successful, fill the modal form
                        if (data.status === 'success') {
                            modalEl.querySelector('.modal-body').innerHTML = data.dom;
                        } else {
                            console.error('Erreur : données introuvables.');
                        }
                    })
                    .catch(error => {
                        // Handle any AJAX errors
                        console.error('Erreur AJAX :', error);
                    });
            }
        });
    });
});
