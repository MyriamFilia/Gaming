<?php
   require_once 'session.php';
   
    // Vérifier si l'utilisateur est connecté. Ceci est généralement fait en vérifiant une variable de session.
    if (!isset($_SESSION['user_id'])) { // Supposons que 'user_id' est défini lors de la connexion
        // L'utilisateur n'est pas connecté, le rediriger vers la page de connexion
        header('Location: index.php');
        exit;
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming - Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/classement.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>


    <?php require('header.php'); ?>

    <main>
        <div class="container">
            <div class="ranking-header">
                <h1>Classement des joueurs</h1>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Rang</th>
                        <th>Pseudo</th>
                        <th>Parties jouées</th>
                        <th>Victoires</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($classement as $joueur): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($joueur['rang']?? ''); ?></td>
                            <td><?php echo htmlspecialchars($joueur['pseudo']?? ''); ?></td>
                            <td><?php echo htmlspecialchars($joueur['nb_parties']?? ''); ?></td>
                            <td><?php echo htmlspecialchars($joueur['nb_victoires']?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>