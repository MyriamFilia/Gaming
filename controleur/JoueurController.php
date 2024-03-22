<?php 
    require_once '../vue/client/session.php';
    require_once __DIR__ . '/../model/JoueurManager.php';

    $joueurManager = new JoueurManager($db);
    
    $action = $_GET['action'] ?? $_POST['action'] ?? 'afficher';

    switch($action) {
        case 'suspendre':
            //
            break;  
        case 'modifierMotdepasse':
            modifierMotdepasse($joueurManager);
            break;
        case 'modifierPseudo':
            modifierPseudo($joueurManager);
            break;
        case 'modifierImageProfil':
            modifierImageProfil($joueurManager);
            break;
        case 'modifierStatistique':
            modifierStatistique($joueurManager);
            break;
        case 'afficher':

            break;
        default:
        echo "Action non reconnue";
        break;
    }


    function modifierMotdepasse ($joueurManager){

        $idJoueur = $_SESSION['user_id'];

        $motDePasseActuel = $_POST['ancienMotdepasse'] ?? '';
        $nouveauMotDePasse = $_POST['nouveauMotdepasse'] ?? '';
        $confirmationMotDePasse = $_POST['confirmMotdepasse'] ?? '';

        if ($nouveauMotDePasse !== $confirmationMotDePasse) {
            echo "Les mots de passe ne correspondent pas.";
            return;
        }
        $joueurdata = $joueurManager->retrouverJoueurId($idJoueur);
        if (!$joueurdata) {
            echo "Joueur non trouvé.";
            return;
        }
        if (!password_verify($motDePasseActuel, $joueurdata['mot_de_passe'])) {
            echo "Le mot de passe actuel est incorrect.";
            return;
        }
        if ($motDePasseActuel == $nouveauMotDePasse){
            echo "Le nouveau mot de passe ne peut être le même que le mot de passe actuel.";
            return;
        }
        $joueur = new Joueur();
        $joueur->setIdJoueur($idJoueur);
        $joueur->setMotDePasse($nouveauMotDePasse);
        
        $joueurManager->modifierMotdePasse($joueur);
        echo "Mot de passe mis à jour avec succès.";

    }

    function modifierPseudo ($joueurManager){

        if (isset($_POST['newUsername']) && !empty($_POST['newUsername']) && isset($_SESSION['user_id'])) {
            $nouveauPseudo = $_POST['newUsername'];
            $idJoueur = $_SESSION['user_id'];
        
            $joueurManager->modifierPseudo($idJoueur, $nouveauPseudo);

            $_SESSION['pseudo'] = $nouveauPseudo;
        
            echo "Pseudo mis à jour avec succès !";
        } else {
            echo "Erreur lors de la mise à jour du pseudo.";
        }
        

    }


    function modifierImageProfil ($joueurManager) {
        $idJoueur = $_SESSION['user_id'];
        $ancienneImage = $_SESSION['image'];
        $image = null; 
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            if ($_FILES['image']['size'] <= 1000000) {
                $infosfichier = pathinfo($_FILES['image']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = ['jpg', 'jpeg', 'gif', 'png'];
                if (in_array($extension_upload, $extensions_autorisees)) {
                    $nomFichier = uniqid() . '.' . $extension_upload;
                    move_uploaded_file($_FILES['image']['tmp_name'], '../images/profil/' . $nomFichier);
                    $image = $nomFichier;
                    if (!empty($ancienneImage) && file_exists('../images/profil/' . $ancienneImage)) {
                        unlink('../images/profil/' . $ancienneImage);
                    }
                }
                $joueurManager->modifierImageProfil($idJoueur , $image);
                $_SESSION['image'] = $image;
                echo "L'image a été mise à jour avec succès.";
                header("location:../vue/client/profil.php");
            } else {
                echo "Erreur lors du téléchargement de l'image.";
            }
            
        }else {
            echo "Erreur ou pas d'image envoyée.";
        }

    }

    function modifierStatistique ($joueurManager) {
        $idJoueur = $_SESSION['user_id'];
        $nbParties = $_POST['parties'];
        $nbVictoires = $_POST['victoires'];
        $joueurManager->modifierStatistiques($idJoueur, $nbParties, $nbVictoires);
        echo "Statistiques mis à jour avec succès.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;

    }

    function suspendreJoueur () {

    }