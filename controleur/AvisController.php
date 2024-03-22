<?php 
    require_once __DIR__ . '/../vue/client/session.php';
    require_once __DIR__ . '/../model/AvisManager.php';
    require_once __DIR__ . '/../model/Jeu.php';
    
    $AvisManager = new AvisManager($db);

    $action = $_GET['action'] ?? $_POST['action'] ?? 'afficher';

    switch($action) {
        case 'ajouter':
            ajouterAvis($AvisManager);
            break;
        case'supprimer':
            supprimerAvis($AvisManager);
            break;
        case 'afficher':
            afficherAvis($AvisManager);
            break;
        default:
            echo "Action non reconnue";
            break;
    }


    function afficherAvis($AvisManager){

    }

    function ajouterAvis($AvisManager){
        $idJeu = $_POST['idJeu'];
        $idJoueur = $_SESSION['user_id'];
        $note = $_POST['note'] ?? null;
        $commentaire = $_POST['commentaire'] ?? null;

        $AvisManager->ajouterAvis($idJeu, $idJoueur, $note, $commentaire);
        header("location:../vue/client/detailjeu.php?id=".$idJeu);
        exit;
    }

    

    function supprimerAvis($AvisManager){

    }