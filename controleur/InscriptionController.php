<?php

    require_once "../model/JoueurManager.php";


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pseudo = $_POST['pseudo'];
        $motDePasse = $_POST['mot_de_passe'];
        $verifPass = $_POST['pass_confirm'];
        $pays = $_POST['pays'];

        if ($verifPass == $motDePasse) {
            $motDePasse = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);      
        
            $joueurManager = new JoueurManager($db);
            $joueur = new Joueur();
            $joueur->setPseudo($pseudo);
            $joueur->setMotDePasse($motDePasse);
            $joueur->setPays($pays);
            $joueurManager->ajouterJoueur($joueur);

            echo "Nouveau Joueur créer avec succès";
            header("location: ../vue/client/connexion.php");

        } else {
            echo "Les mots de passe ne correspondent pas";
            header("location: ../vue/client/inscription.php");
        }

    } 
