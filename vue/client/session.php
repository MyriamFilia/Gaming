<?php 

    session_start();

    // Durée maximale d'inactivité en secondes (ex. 1800 secondes = 30 minutes)
    $maxInactivite = 15*60;

    // Vérifie si $_SESSION['derniereActivite'] est défini
    if (isset($_SESSION['derniereActivite']) && (time() - $_SESSION['derniereActivite'] > $maxInactivite)) {
        // La session a expiré.
        session_unset();     // Supprime les variables de session.
        session_destroy();   // Détruit la session.
        
        // Redirection vers la page de connexion ou une page d'information.
        header("Location: connexion.php");
        exit;
    }

    // Mettre à jour la dernière activité avec le timestamp actuel.
    $_SESSION['derniereActivite'] = time();

?>