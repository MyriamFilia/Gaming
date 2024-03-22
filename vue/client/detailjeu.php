<?php
    require_once 'session.php';

    // Vérifier si l'utilisateur est connecté. Ceci est généralement fait en vérifiant une variable de session.
    if (!isset($_SESSION['user_id'])) { // Supposons que 'user_id' est défini lors de la connexion
        // L'utilisateur n'est pas connecté, le rediriger vers la page de connexion
        header('Location: index.php');
        exit;
    }
?>

<?php 
    require_once  '../../controleur/JeuxController.php';
    require_once '../../model/AvisManager.php';

    if (isset($_GET['id'])) {
       $idJeu = $_GET['id'];
       $jeu = $jeuManager->afficherUnJeu($idJeu);
       if (!$jeu) {
           die("Jeu non trouvé.");
       }
    }

    $avisManager = new AvisManager($db);
    $note = $avisManager->notedunJeu($idJeu);
    $lesCommentaires = $avisManager->afficherCommentaires($idJeu);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming - Détails Jeu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/detailjeu.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <?php require('header.php'); ?>


    <div class="container col-8" id="container1">
        <!-- Image de couverture -->
        <div class="">
            <div class="container" id="container1">
                <div class="d-flex justify-content-between align-items-center">
                    <h3><?= htmlspecialchars($jeu->getNom()?? '') ?></h3>
                    <div class="favorite-icon">
                        <button class="add-to-favorites btn btn-primary boutona" id="btnaa" data-jeu-id="<?php echo $jeu->getIdJeu(); ?>">
                            Ajouter aux favoris
                        </button>
                        <div class="messageContainer" data-jeu-id="<?= $jeu->getIdJeu(); ?>"></div>
                    </div>    
                </div>
            </div>
            <img src="../../images/jeux/<?= htmlspecialchars($jeu->getImage()?? '') ?>" class="cover-image" alt="Couverture du jeu" style="width: 100%;">    
        </div>
        
        <!-- Informations du jeu -->
        <div class="container my-4" id="container1">
            <div class="row">
                <div class="col-md-6 text-muted">
                    <p>Date de sortie: <?= htmlspecialchars($jeu->getDateSortie()?? '') ?></p>
                    <p>Studio: <?= htmlspecialchars($jeu->getStudio()?? '') ?></p>
                    <div class="rating">
                        <span class="">Notes: </span>
                        <?php
                        for ($i = 0; $i < 5; $i++) {
                            if ($note >= $i + 1) {
                                echo '<i class="fas fa-star checked"></i>';
                            } elseif ($note >= $i + 0.5) {
                                echo '<i class="fas fa-star-half-alt checked"></i>';
                            } else {
                                echo '<i class="far fa-star"></i>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-6 text-end text-muted">
                    <p>PEGI: <?= htmlspecialchars($jeu->getAgeMin()?? '') ?></p>
                    <p>Genre: <?= htmlspecialchars($jeu->getGenre()?? '') ?></p>
                    <button class="btn btn-secondary boutona mt-4" id="btnaa" data-bs-toggle="modal" data-bs-target="#commentModal">Ajouter un commentaire</button>
                </div>
            </div>
        </div>

        <div class="container mb-4" id="container1">
            <div class="row">
                <div class="col-md-6">
                    <h2>Description</h2>
                    <div class="content-collapse" id="descriptionText">
                        <p style="text-align: justify;">
                        <?= htmlspecialchars($jeu->getDescription()?? '')?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2>Règles du jeu</h2>
                    <div class="content-collapse" id="rulesText">
                        <p style="text-align: justify;">
                        <?= htmlspecialchars($jeu->getRegles()?? '')?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Commentaires -->
        <div class="container" id="container1">
            <h2>Commentaires</h2>
            <?php foreach ($lesCommentaires as $commentaire): ?>        
                <div class="mb-3">
                    <div class="d-flex mb-2">
                    <img src="../../images/profil/<?= isset($commentaire['img_profil']) ? htmlspecialchars($commentaire['img_profil']) : 'default.png' ?>" class="rounded-circle" alt="Avatar" style="width: 50px; height: 50px; object-fit: cover;">
                        <div class="ms-3">
                            <h5 class="mb-0"><?= htmlspecialchars($commentaire['pseudo']) ?> </h5>
                            <span class="text-muted date"><?= htmlspecialchars($commentaire['date_publication']) ?></span>
                            <p style="text-align: justify;"><?= htmlspecialchars($commentaire['commentaire']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">Ajouter un commentaire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="../../controleur/AvisController.php?action=ajouter">
                        <input type="hidden" name="idJeu" value="<?php echo $jeu->getIdJeu(); ?>">
                        <div class="mb-3">
                            <label for="comment-text" class="col-form-label">Note:</label>
                            <input class="form-control" type="number" name="note" min="1" max="5" >
                        </div>
                        
                        <div class="mb-3">
                            <label for="comment-text" class="col-form-label">Commentaire:</label>
                            <textarea class="form-control" id="comment-text" name="commentaire" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class=" btn btn-danger btn-secondary " data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary boutona" id="btnaa">Envoyer</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/ajoutfav.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>