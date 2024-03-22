<?php
// Paramètres de connexion à la base de données
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_DATABASE", "gaming");

    // Créer la connexion
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

    // Vérifier la connexion
    if ($db->connect_error) {
        die("La connexion a échoué : " . $db->connect_error);
    }

    // Informations de l'administrateur à créer
    $pseudoAdmin = 'admin'; 
    $motDePasseAdmin = 'admin'; 
    $roleAdmin = 'admin'; 

    // Hacher le mot de passe
    $motDePasseHache = password_hash($motDePasseAdmin, PASSWORD_DEFAULT);

    // Préparer la requête SQL pour insérer l'administrateur
    $sql = "INSERT INTO joueurs (pseudo, mot_de_passe, role) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);

    // Lier les paramètres et exécuter la requête
    $stmt->bind_param("sss", $pseudoAdmin, $motDePasseHache, $roleAdmin);

    if ($stmt->execute()) {
        echo "Le compte administrateur a été créé avec succès.";
    } else {
        echo "Erreur lors de la création du compte administrateur : " . $stmt->error;
    }

    // Fermer la connexion
    $stmt->close();
    $db->close();
    ?>
