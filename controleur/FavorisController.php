<?php 
    require_once __DIR__ . '/../vue/client/session.php';
    require_once __DIR__ . '/../model/FavorisManager.php';
    require_once __DIR__ . '/../model/Jeu.php';
    
    $FavorisManager = new FavorisManager($db);

    $action = $_GET['action'] ?? $_POST['action'] ?? 'afficher';

    switch($action) {
        case 'ajouter':
            ajouterFavoris($FavorisManager);
            break;
        case'supprimer':
            supprimerFavoris($FavorisManager);
            break;
        case 'afficher':
            afficherFavoris($FavorisManager);
            break;
        default:
            echo "Action non reconnue";
            break;
    }

    function afficherFavoris($FavorisManager){
        return $FavorisManager->afficherToutFavoris();     
    }

    function ajouterFavoris($FavorisManager){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_jeu'])) {
            $idJeu = $_POST['id_jeu'];
            $idJoueur = $_SESSION['user_id'];
            if (!$FavorisManager->estDejaFavori($idJoueur, $idJeu)) {
                $FavorisManager->ajouterFavoris($idJoueur, $idJeu); 
                echo "Le jeu a été ajouté dans les favoris";
            } else {
                echo "Le jeu est déjà dans les favoris"; 
            }
        }
    }

   

    function supprimerFavoris($FavorisManager){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_jeu'])) {
            $idJeu = $_POST['id_jeu'];
            $idJoueur = $_SESSION['user_id'];
            $FavorisManager->supprimerFavoris( $idJoueur ,$idJeu);
            header('Location:../vue/client/favoris.php');
            exit;
        }
    }
