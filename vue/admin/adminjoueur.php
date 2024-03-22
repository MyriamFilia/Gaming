<?php 
    require '../client/session.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming - Admin</title>
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>

    <?php require('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <?php require('sidebar.php'); ?>

            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">

                <h2>Administration des joueurs</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Pseudo</th>
                                <th>Pays</th>
                                <th>Nombre de parties</th>
                                <th>Nombre de victoires</th>
                                <th>Date inscription</th>
                                <th>Date connexion</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>100</td>
                                <td>Joueur1</td>
                                <td>joueur1@example.com</td>
                                <td>1</td>
                                <td>100</td>
                                <td>90</td>
                                <td>90</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Suspendre</button>
                                    <button class="btn btn-danger btn-sm">Supprimer</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
