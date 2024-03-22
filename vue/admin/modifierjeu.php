<?php 
    require '../client/session.php';
    require_once  '../../controleur/JeuxController.php';

    if (isset($_GET['id'])) {
        $idJeu = $_GET['id'];
        $jeu = $jeuManager->afficherUnJeu($idJeu);
        if (!$jeu) {
            die("Jeu non trouvé.");
        }
    }
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
        
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 d-flex justify-content-center  align-items-center mb-5" style="min-height: 100vh;">

                <div class="w-100 " style="max-width: 800px;" id="">
                    <h2 class="text-center mt-4 mb-4">Modification du jeu : <?= htmlspecialchars($jeu->getNom()) ?></h2>
                    <div class="card shadow">
                        <form action="../../controleur/JeuxController.php?action=modifier" method="POST" enctype="multipart/form-data" class="p-4">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $jeu->getIdJeu() ?>">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($jeu->getNom() ?? '') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Studio</label>
                                    <input type="text" class="form-control" name="studio" value="<?= htmlspecialchars($jeu->getStudio() ?? '') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Age Minimum</label>
                                    <input type="text" class="form-control" name="pegi" value="<?= htmlspecialchars($jeu->getAgeMin() ?? '') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Genre</label>
                                    <input type="text" class="form-control" name="genre" value="<?= htmlspecialchars($jeu->getGenre() ?? '') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Date de Sortie</label>
                                    <input type="date" class="form-control" name="date_sortie" value="<?= htmlspecialchars($jeu->getDateSortie() ?? '') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="regles" class="form-label">Règles</label>
                                    <textarea class="form-control" id="regles" name="regles" rows="4"><?= htmlspecialchars($jeu->getRegles() ?? '') ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($jeu->getDescription() ?? '') ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <div>
                                        <img id="imageActuelle" name="imageActuelle" src="../../images/jeux/<?= htmlspecialchars($jeu->getImage()?? '') ?>" alt="Image du jeu" style="max-width: 100%; max-height: 200px;">
                                    </div>
                                    <label for="nouvelleImage" class="form-label mt-3">Modifier l'image</label>
                                    <input type="file" class="form-control" id="nouvelleImage" name="nouvelleImage">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary btn-danger" onclick="return confirm('Voulez-vous vraiment sauvegarder les changements ?');">Sauvegarder les changements</button>
                            </div>
                        </form>
                    
                    </div>
                </div>

            </main>
        </div>
    </div>
    
</body>
</html>