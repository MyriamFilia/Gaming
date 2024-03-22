

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming - Inscription</title>
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/inscription.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-10 col-lg-7 col-xl-5">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 36px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Inscription</h3>
                            
                            <form action="../../controleur/InscriptionController.php" method="POST">

                                <div class="row">
                                    <div class="col-md-12 mb-4 d-flex align-items-center">
                                        <div class="form-outline datepicker w-100">
                                            <input type="text" name="pseudo" class="form-control form-control-lg" id="birthdayDate" placeholder="Pseudo" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <input type="password" name="mot_de_passe" class="form-control form-control-lg" id="" placeholder="Mot de Passe" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <input type="password" name="pass_confirm" class="form-control form-control-lg" id="" placeholder="Confirmer le mot de passe" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-2 d-flex align-items-center">
                                        <div class="form-outline w-100 align-items-center" style="display: flex; align-items: center;">
                                            <select name="pays" id="paysSelect" class="form-control form-control-lg" onchange="showFlag()">
                                                <?php
                                                include 'api.php';
                                                foreach ($countries as $country) {
                                                    $countryName = htmlspecialchars($country["name"]["common"], ENT_QUOTES, 'UTF-8');
                                                    echo "<option value=\"{$country['flags']['svg']}\">$countryName</option>";
                                                }
                                                ?>
                                            </select>
                                            <div id="flagContainer" class="ms-2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4 pt-2 mb-3 boutonc form-outline">
                                    <button class="col-md-6 btn btn-lg boutona" type="submit">S'inscrire</button>
                                </div>

                                <div class="row boutonc">
                                    <a href="connexion.php" class="col-md-6" style="text-decoration: none; color: black; text-decoration: underline">Se Connecter</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        function showFlag() {
            var select = document.getElementById('paysSelect');
            var flagContainer = document.getElementById('flagContainer');
            var flagUrl = select.value; // L'URL du drapeau est stockée comme valeur de l'option
            flagContainer.innerHTML = '<img src="' + flagUrl + '" alt="Drapeau" style="width: 60px;">';
        }
</script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>