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
    <link rel="stylesheet" href="../../css/favoris.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>


    <?php require('header.php'); ?>

    <main>
        <div class="container mt-5">
            <h2>Profil Utilisateur</h2>
            <div class="row">
                <div class="col-md-4 text-center">
                    <?php 
                        if(empty($_SESSION['image'])) {
                            echo '<img src="https://via.placeholder.com/300" alt="Photo de profil" class="profile-image mb-5 mt-5">';
                        } else {
                            echo '<img src="../../images/profil/'. htmlspecialchars($_SESSION['image']) .'" alt="Photo de profil" class="profile-image mb-5 mt-5" width="300" height="300">';
                        }
                    ?>
                    <form method="post" enctype="multipart/form-data" action ="../../controleur/JoueurController.php?action=modifierImageProfil">
                        <div class="mb-3">
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 boutona">Mettre à jour l'image</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <form id="formModifierPseudo">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="currentUsername" class="form-label">Pseudo actuel</label>
                                <input type="text" class="form-control" id="currentUsername" value="<?php echo htmlspecialchars($_SESSION['pseudo']); ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="newUsername" class="form-label">Nouveau pseudo</label>
                                <input type="text" class="form-control" id="newUsername" name="newUsername" placeholder="Nouveau pseudo">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-3 boutona">Mettre à jour le pseudo</button>
                    </form>

                    <hr>
                    <h4>Changer de mot de passe</h4>
                    <div id="messageErreur" style="display: none; color:brown;"></div>
                    <form id="formModifierMotDePasse" >
                        <div class="mb-3">
                            <input type="password" class="form-control" name="ancienMotdepasse" placeholder="Mot de passe actuel">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" name="nouveauMotdepasse" placeholder="Nouveau mot de passe">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="confirmMotdepasse" placeholder="Confirmer le nouveau mot de passe">
                        </div>
                        <button type="submit" class="btn btn-primary boutona">Changer de mot de passe</button>
                    </form>
                </div>
            </div>
        </div>
    </main>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#formModifierMotDePasse").on("submit", function(e) {
                e.preventDefault(); // Empêcher le formulaire de soumettre normalement
                $.ajax({
                    type: "POST",
                    url: "../../controleur/JoueurController.php?action=modifierMotdepasse", // Le fichier PHP qui traite la soumission
                    data: $(this).serialize(), // Sérialiser les données du formulaire
                    success: function(response) {
                        $("#messageErreur").show().html(response);
                        $("#formModifierMotDePasse").trigger("reset");
                    },
                    error: function() {
                        $("#messageErreur").show().html("Une erreur s'est produite lors de la requête.");
                    }
                });
            });


            $("#formModifierPseudo").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../../controleur/JoueurController.php?action=modifierPseudo", 
                    data: {
                        newUsername: $("#newUsername").val(),
                    },
                    success: function(response) {
                        alert("Pseudo mis à jour avec succès !");
                        $("#currentUsername").val($("#newUsername").val());
                        $("#newUsername").val("");
                        
                    }
                });
            });

        
            
        });
    </script>

    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>