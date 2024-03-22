<?php 
    require_once __DIR__ . '/../vue/client/session.php';
    require_once __DIR__ . '/../model/JeuManager.php';
    
    $jeuManager = new JeuManager($db);

    $action = $_GET['action'] ?? $_POST['action'] ?? 'afficher';

    switch($action) {
        case 'ajouter':
            ajouterJeu($jeuManager);
            break;
        case 'supprimer':
            supprimerJeu($jeuManager);
            break;
        case 'modifier':
            modifierJeu($jeuManager);
            break;
        case 'filtrer':
            filtrerJeux($jeuManager);
            break;
        case 'afficher':
        default:
            // L'action par défaut est 'afficher'
            $jeuManager->afficherJeux();
            $jeux = $jeuManager->getJeux();
            break;
    }


    function afficherJeux($jeuManager) {
        return $jeuManager->getJeux();
    }

    function ajouterJeu($jeuManager){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $studio = $_POST['studio'];
            $description = $_POST['description'];
            $regles = $_POST['regles'];
            $genre = $_POST['genre'];
            $age_min = $_POST['pegi'];
            $date_sortie = $_POST['date_sortie'];
            $image = null; 
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                if ($_FILES['image']['size'] <= 1000000) {
                    $infosfichier = pathinfo($_FILES['image']['name']);
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = ['jpg', 'jpeg', 'gif', 'png'];
                    if (in_array($extension_upload, $extensions_autorisees)) {
                        $nomFichier = uniqid() . '.' . $extension_upload;
                        move_uploaded_file($_FILES['image']['tmp_name'], '../images/jeux/' . $nomFichier);
                        $image = $nomFichier;
                    }
                }
            }

            $jeu = new Jeu();
            $jeu->setNom($nom);
            $jeu->setStudio($studio);
            $jeu->setDescription($description);
            $jeu->setRegles($regles);
            $jeu->setGenre($genre);
            $jeu->setAgeMin($age_min);
            $jeu->setDateSortie($date_sortie);
            $jeu->setImage($image);
            
            
            if($jeuManager->ajouterJeu($jeu)) {
                echo "Nouveau jeu ajouté avec succès.";
                header('Location: ../vue/admin/admin.php');
            } else {
                echo "Erreur lors de l'ajout du jeu.";
                header('Location: ../vue/admin/error.php');
            }
        } else {
            echo "Méthode non autorisée";
            header('Location: ../vue/admin/error.php');
        }
    }


    function modifierJeu($jeuManager){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $jeu = $jeuManager->afficherUnJeu($id);

            if (isset($_FILES['nouvelleImage']) && $_FILES['nouvelleImage']['error'] == 0) {
                $cheminImages = '../images/jeux/';
                $ancienneImage = $jeu->getImage();
                if ($ancienneImage && file_exists($cheminImages . $ancienneImage)) {
                    unlink($cheminImages . $ancienneImage);
                }

                $infosFichier = pathinfo($_FILES['nouvelleImage']['name']);
                $extension = $infosFichier['extension'];
                $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'gif'];
                
                if (in_array($extension, $extensionsAutorisees)) {
                    $nouveauNomFichier = uniqid() . '.' . $extension;
                    move_uploaded_file($_FILES['nouvelleImage']['tmp_name'], $cheminImages . $nouveauNomFichier);
                    $jeu->setImage($nouveauNomFichier);
                }
            }
            $jeu->setNom($_POST['nom']);
            $jeu->setDescription($_POST['description']);
            $jeu->setStudio($_POST['studio']);
            $jeu->setRegles($_POST['regles']);
            $jeu->setGenre($_POST['genre']);
            $jeu->setAgeMin($_POST['pegi']);
            $jeu->setDateSortie($_POST['date_sortie']);

            $jeuManager->modifierJeu($jeu);
        
            header('Location: ../vue/admin/modifierjeu.php?id=' . $id);
            exit;
        }
        
    }


    function supprimerJeu($jeuManager){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $jeu = $jeuManager->afficherUnJeu($id);
            $jeuManager->supprimerJeu($jeu);
            header('Location:../vue/admin/admin.php');
            exit;
        }
    }

    function filtrerJeux($jeuManager){
        $genre = $_POST['genre'] ?? '';
        $note = $_POST['note'] ?? '';
        $_SESSION['filtres'] = [
            'genre' => $genre,
            'note' => $note
        ];
        header('Location:../vue/client/jeux.php');
        exit;
    }


    




    




 

    