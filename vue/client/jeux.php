<?php
    require_once 'session.php';
    require_once __DIR__ . '../../../controleur/JeuxController.php';
    require_once __DIR__. '../../../model/JeuManager.php';


    // Vérifier si l'utilisateur est connecté. Ceci est généralement fait en vérifiant une variable de session.
    if (!isset($_SESSION['user_id'])) { // Supposons que 'user_id' est défini lors de la connexion
        // L'utilisateur n'est pas connecté, le rediriger vers la page de connexion
        header('Location: index.php');
        exit;
    }
    
    $jeuManager = new JeuManager($db);
    $genres = $jeuManager->genres();

    if (isset($_SESSION['filtres'])) {
        $filtres = $_SESSION['filtres'];
        $jeux = $jeuManager->chargerJeuxFiltres($filtres['genre'], $filtres['note']);
        unset($_SESSION['filtres']);
    }

  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming - Jeux</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/jeux.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>

    <?php require('header.php'); ?>

    

        <section class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4>Filtres</h4>
                        <form action="../../controleur/JeuxController.php?action=filtrer" method="post">
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre</label>
                                <select class="form-select" id="genre" name="genre">
                                    <option selected>Choisir...</option>
                                    <?php foreach ($genres as $genre): ?>
                                        <option value="<?= htmlspecialchars($genre) ?>"><?= htmlspecialchars($genre) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Note</label>
                                <select class="form-select" id="rating" name="note">
                                    <option selected>Choisir...</option>
                                    <option value="1">1 étoile et plus</option>
                                    <option value="2">2 étoiles et plus</option>
                                    <option value="3">3 étoiles et plus</option>
                                    <option value="4">4 étoiles et plus</option>
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit" id="applyFilters">Appliquer les filtres</button>
                        </form>
                    </div>
                        
                    <div class="col-md-9">
                        <h2 class="text-start">Tous les jeux</h2>
                        <section class="mt-5">
                            <div class="row">
                                <?php foreach($jeux as $jeu): ?>   
                                    <div class="col-md-4 game-col">
                                        <?php require('cardjeu.php'); ?>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/ajoutfav.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>