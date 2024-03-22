$(document).ready(function() {
    $('.add-to-favorites').click(function() {
        var jeuId = $(this).data('jeu-id'); // Récupère l'ID du jeu
        $.ajax({
            type: "POST",
            url: "../../controleur/FavorisController.php",
            data: {
                action: "ajouter", // Assurez-vous que cette action est traitée correctement côté serveur
                id_jeu: jeuId
            },
            success: function(response) {
                var messageContainer = $('.messageContainer[data-jeu-id="' + jeuId + '"]');
                messageContainer.html(response);
                setTimeout(function() {
                    messageContainer.fadeOut('slow', function() {
                        messageContainer.html(""); // Vide le conteneur
                        messageContainer.show(); // Prépare le conteneur pour une future utilisation
                    });
                }, 2000);
            }
        });
    });
});

