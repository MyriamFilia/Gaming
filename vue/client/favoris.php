<?php
    require_once 'session.php';
    require '../../model/FavorisManager.php';
    require '../../controleur/FavorisController.php';


    // Vérifier si l'utilisateur est connecté. Ceci est généralement fait en vérifiant une variable de session.
    if (!isset($_SESSION['user_id'])) { // Supposons que 'user_id' est défini lors de la connexion
        // L'utilisateur n'est pas connecté, le rediriger vers la page de connexion
        header('Location: index.php');
        exit;
    }

    $favorisManager = new FavorisManager($db);
    $jeuxFavoris = $favorisManager->afficherFavorisJoueur();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming - Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/favoris.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>


    <?php require('header.php'); ?>

    <main>
        <div class="container mt-5">
            <h2>Mes jeux favoris</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Nom du Jeu</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($jeuxFavoris as $jeu):?>
                        <tr>
                            <td>
                                <img src="../../images/jeux/<?= htmlspecialchars($jeu->getImage()?? '') ?>" style="width: 65px; height: auto;">
                            </td>
                            <td><?= htmlspecialchars($jeu->getNom()?? '') ?></td>
                            <td><?= htmlspecialchars($jeu->getGenre()?? '') ?></td>
                            <td>
                                <form action="../../controleur/FavorisController.php?action=supprimer" method="post">
                                    <input type="hidden" name="action" value="supprimerFavoris">
                                    <input type="hidden" name="id_jeu" value="<?php echo $jeu->getIdJeu(); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce jeu ?')">Retirer des Favoris</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>

    </main>
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>