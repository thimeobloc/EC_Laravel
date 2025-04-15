// 1. Afficher une alerte au click sur un des boutons de la liste
function handleClick(event, button) {
    event.preventDefault();
    console.log("Bouton cliqué");
    alert("Bouton enclenché");
}

// 2. Afficher l'attribut data-route qui est placé sur le bouton


const modalTables = document.querySelectorAll('.table-with-modal');

modalTables.forEach(function(table, i) {
    table.addEventListener('click', function(event) {
        let target = event.target;

        if(target.classList.contains('btn') ) {
            const route = target.getAttribute('data-route'); // Get the route attribute from the button
            const modalEl = document.querySelector(target.getAttribute('data-modal'));  // Select the modal

            // AJAX call via the route
            fetch(route)
                .then(response => response.json())  // Ensure the response is JSON
                .then(data => {
                    console.log('AJAX response succeeded:', data);

                    // Check if the response contains user data
                    if(data.status === 'success' && data.user) {
                        // Fill the modal fields with the user data
                        document.getElementById('student_id').value = data.user.id;
                        document.getElementById('last_name').value = data.user.last_name;
                        document.getElementById('first_name').value = data.user.first_name;
                        document.getElementById('birth_date').value = data.user.birth_date;
                        document.getElementById('email').value = data.user.email;

                        // When the call is successful: show the modal
                        const modal = KTModal.getInstance(modalEl); // Get the modal instance
                        modal.show();  // Show the modal
                        console.log('AJAX call completed successfully!');
                    } else {
                        console.error('Error: user not found');
                    }
                })
                .catch(error => {
                    console.error('Error during the AJAX call:', error);
                    console.log('The AJAX call failed.');
                });
        }
    });
});




