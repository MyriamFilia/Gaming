<?php 
require_once '../vue/client/session.php';
require_once "../model/JoueurManager.php";

//session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $motDePasse = $_POST['mot_de_passe'];
    
    $joueurManager = new JoueurManager($db);
    $utilisateur = $joueurManager->retrouverJoueur($pseudo, $motDePasse);

    if ($utilisateur) {
        $_SESSION['user_id'] = $utilisateur['id'];
        $_SESSION['role'] = $utilisateur['role'];
        $_SESSION['pseudo'] = $utilisateur['pseudo'];
        $_SESSION['image'] = $utilisateur['image'];
        $joueurManager->mettreAJourDerniereConnexion($utilisateur['id']);
        if ($_SESSION['role'] == 'admin' ) {
            header("location: ../vue/admin/admin.php");
        } elseif ($_SESSION['role'] == 'joueur') {
            header("location: ../vue/client/apresconnexion.php");
        }
    } else {
        header("location: ../vue/client/connexion.php?error=invalid");
    }
}
?>
