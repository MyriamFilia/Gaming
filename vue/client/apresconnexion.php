<?php
    require_once 'session.php';
    require '../../model/JeuManager.php';

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }

    $jeuManager = new JeuManager($db);
    $jeuxLesPlusAimes = $jeuManager->jeuxLesPlusAimes();
    $jeuxEnFavoris = $jeuManager->jeuxEnFavoris();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming - Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/apresconnexion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>


    <?php require('header.php'); ?>

    <main>
        <!-- Bienvenue à l'utilisateur dans son espaces -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-start"><?= htmlspecialchars($_SESSION['pseudo']); ?>, heureux de vous revoir</h2>
                </div>
            </div>
        </div>
        <!-- Fin -->
        <!-- Carrousel -->
        <section class="">
            <div class="container mt-5 carousel-container">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner ">
                        <div class="carousel-item active">
                            <img src="../../images/carrousel1.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption ">
                                <h5>Plongez dans l'aventure</h5>
                                <p>Votre quête commence ici !</p>
                                <a href="jeux.php" class="btn btn-primary boutona">Découvrez les jeux</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="../../images/carrousel2.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption">
                                <h5>Rejoignez la bataille</h5>
                                <p>Des mondes à conquérir vous attendent !</p>
                                <a href="classement.php" class="btn btn-primary boutona">Voir le classement</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="../../images/carrousel3.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption">
                                <h5>Dévoilez Votre Puissance</h5>
                                <p>Partagez vos statistiques et classez vous parmi les meilleurs.</p>
                                <a href="#" class="btn btn-primary boutona" data-bs-toggle="modal" data-bs-target="#statsModal">Saisissez vos stats</a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

        </section>
        <!-- Fin Carrousel -->
        <!-- section des jeux les plus likés -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-start">--> Top des jeux les plus likés</h2>
                </div>
            </div>
        </div>
        <section class="mt-5">
            <div class="container">
                <div class="row">
                    <?php foreach ($jeuxLesPlusAimes as $jeu): ?>
                        <div class="col-md-3 game-col">
                            <?php require('cardjeu.php'); ?>
                        </div>
                    <?php endforeach;?>
                    
                </div>
            </div>
        </section>
        <!-- Fin section des jeux les plus likés -->

        <!-- section des jeux recommandés -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-start">--> Les Jeux que vous pourriez aimer</h2>
                </div>
            </div>
        </div>
        <section class="mt-5">
            <div class="container">
                <div class="row">
                    <?php foreach ($jeuxEnFavoris as $jeu): ?>
                        <div class="col-md-3 game-col">
                            <?php require('cardjeu.php'); ?>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </section>
        <!-- Fin section -->


    </main>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/ajoutfav.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>