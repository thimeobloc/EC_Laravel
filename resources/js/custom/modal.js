document.addEventListener('DOMContentLoaded', function () {
    // Select all tables with modal functionality
    const modalTables = document.querySelectorAll('.table-with-modal');

    // Loop through each table
    modalTables.forEach(function (table) {
        table.addEventListener('click', function (event) {
            const target = event.target;

            // Check if the clicked element is a button
            if (target.classList.contains('btn')) {
                const route         = target.getAttribute('data-route'); // Get the route for the AJAX request
                const modalSelector = target.getAttribute('data-modal'); // Get the modal selector
                const modalEl       = document.querySelector(modalSelector); // Find the modal element
                const modal         = KTModal.getInstance(modalEl); // Get the modal instance using KTModal

                // Check if the modal exists
                if (!modalEl) {
                    console.error(`The modal ${modalSelector} was not found.`); // Log an error if the modal is not found
                    return;
                }

                // Show a loading spinner in the modal body
                const modalBody = modalEl.querySelector('.modal-body');
                modalBody.innerHTML = '<div class="spinner">Loading...</div>'; // Display a loading message with a spinner

                modal.show(); // Display the modal

                // Make the AJAX request
                fetch(route)
                    .then(response => response.json()) // Parse the response as JSON
                    .then(data => {
                        // Check if the request was successful
                        if (data.status === 'success') {
                            modalBody.innerHTML = data.dom; // Inject the returned DOM content into the modal body
                        } else {
                            modalBody.innerHTML = '<p class="error">Error: User not found</p>'; // Display an error message in the modal
                        }
                    })
                    .catch(error => {
                        console.error('AJAX error:', error); // Log the error to the console
                        modalBody.innerHTML = '<p class="error">An error occurred, please try again later.</p>'; // Display a generic error message
                    });
            }
        });
    });
});
