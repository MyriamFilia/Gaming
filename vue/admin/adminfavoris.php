<?php 
    require '../client/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming - Admin</title>
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>

    <?php require('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <?php require('sidebar.php'); ?>

            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">

                <h2>Administration des favoris</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th class="col-4">Joueur</th>
                                <th class="col-4">Jeu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>25</td>
                                <td>100</td>
                                <td>Joueur1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

        <!-- Modal d'ajout de joueur -->
    <div class="modal fade" id="addPlayerModal" tabindex="-1" aria-labelledby="addPlayerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPlayerModalLabel">Ajouter un nouveau favorisr</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPlayerForm">
                    <div class="mb-3">
                        <label for="playerPseudo" class="form-label">Joueur</label>
                        <input type="text" class="form-control" id="playerPseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="playerEmail" class="form-label">EJeu</label>
                        <input type="email" class="form-control" id="playerEmail" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="addPlayer()">Ajouter</button>
            </div>
            </div>
        </div>
    </div>


    <script>
        function addPlayer() {
        var pseudo = document.getElementById('playerPseudo').value;
        var email = document.getElementById('playerEmail').value;
        
        // Ici, vous enverriez les données au serveur via AJAX/fetch ou un formulaire traditionnel
        console.log("Ajouter le joueur:", pseudo, email);
        
        // Fermer le modal après l'ajout
        var modal = bootstrap.Modal.getInstance(document.getElementById('addPlayerModal'));
        modal.hide();
        
        // Mettez à jour votre tableau/UI ici ou redirigez l'utilisateur selon le besoin
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
