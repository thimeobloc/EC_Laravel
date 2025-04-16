$(document).ready(function () {
    // Lorsqu'on clique sur le bouton "edit"
    $('.openModal').click(function () {
        var userId = $(this).data('id');  // Récupère l'ID de l'enseignant

        // Appel AJAX pour récupérer les informations de l'enseignant
        $.ajax({
            url: '/user/' + userId,  // URL qui renvoie les informations de l'utilisateur
            method: 'GET',  // Méthode GET pour obtenir les données
            success: function (data) {
                // Remplir les champs du modal avec les données reçues
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#email').val(data.email);
                $('#birth_date').val(data.birth_date);

                // Ouvre le modal avec l'API de Bootstrap 5
                var modal = new bootstrap.Modal(document.getElementById('infoModal'));
                modal.show();
            },
            error: function () {
                // Si l'appel échoue, on montre une alerte
                alert('Erreur lors de la récupération des données.');
            }
        });
    });
});
