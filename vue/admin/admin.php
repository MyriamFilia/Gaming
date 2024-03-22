<?php
    require '../client/session.php';
    require_once __DIR__ . '../../../controleur/JeuxController.php';
    $jeux = afficherJeux($jeuManager); 
    
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

                <h2>Administration des jeux</h2>
                <div class="table-responsive">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPlayerModal">
                        Ajouter un jeu
                    </button>
                   
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Nom</th>
                                <th>Studio</th>
                                <th>Genre</th>
                                <th>Age minimum</th>
                                <th>Date de Sortie</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($jeux as $jeu): ?>
                            <tr>
                                <td><?= htmlspecialchars($jeu->getIdJeu()?? '') ?></td>
                                <td><?= htmlspecialchars($jeu->getNom()?? '') ?></td>
                                <td><?= htmlspecialchars($jeu->getStudio()?? '') ?></td>
                                <td><?= htmlspecialchars($jeu->getGenre() ?? '') ?></td>
                                <td><?= htmlspecialchars($jeu->getAgeMin()?? '')?></td>
                                <td><?= htmlspecialchars($jeu->getDateSortie()?? '')?></td>
                                <td>
                                    <a href="modifierjeu.php?id=<?= htmlspecialchars($jeu->getIdJeu()) ?>" class="btn btn-primary btn-sm">Modifier</a>
                                    <a href="../../controleur/JeuxController.php?action=supprimer&id=<?= htmlspecialchars($jeu->getIdJeu()) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment suppriemr ce jeu ?')">Supprimer</button>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

        <!-- Modal d'ajout de jeu -->
    <div class="modal fade" id="addPlayerModal" tabindex="-1" aria-labelledby="addPlayerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlayerModalLabel" enctype="multipart/form-data">Ajouter un nouveau jeu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../controleur/JeuxController.php?action=ajouter" method="POST" id="addPlayerForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="text" name="nom" class="form-control" id="jeuNom" placeholder="Nom" required>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Studio</label>
                            <input type="text" name="studio" class="form-control" placeholder="Studio"  required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="genre" class="form-control" placeholder="Genre" required>
                        </div>
                        <div class="mb-3">
                            <input type="date" name="date_sortie" class="form-control" placeholder="Date de Sortie"  required>
                        </div>
                        <div class="mb-3">
                            <input type="number" name="pegi" class="form-control"  placeholder="Age Minimum" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="description" class="form-control" placeholder="Description" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="regles" class="form-control"  placeholder="Règles du jeu" required>
                        </div>
                        <div class="mb-3">
                            <input type="file" name="image" class="form-control" placeholder="Image" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary" >Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
