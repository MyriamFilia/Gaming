
<?php
    require_once 'session.php';
    require '../../model/JoueurManager.php';

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }

    $joueurManager = new JoueurManager($db);
    $classement = $joueurManager->statistiques();
    $rang = $joueurManager->getRangJoueur($_SESSION['user_id']);

?>

<header class="p-3 mb-3 border-bottom navcolor">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                <div class="d-flex mb-md-0 ">
                    <ul class="nav mb-2 justify-content-center mb-md-0">
                        <li><a href="apresconnexion.php" class="nav-link px-2 fs-5 link-dark">Accueil</a></li>
                        <li><a href="jeux.php" class="nav-link px-2 fs-5 link-dark">Les Jeux</a></li>
                        <li><a href="classement.php" class="nav-link px-2 fs-5 link-dark">Classement</a></li>
                        <li><a href="#" class="nav-link px-2 fs-5 link-dark" data-bs-toggle="modal" data-bs-target="#statsModal">Mes Statistiques</a></li>
                    </ul>
                </div>

                <div class="mx-auto ">
                        <span class="fs-4">Top N° <?= htmlspecialchars($rang); ?></span>
                </div>

                <div class="d-flex align-items-center ms-auto">
                    <ul class="nav mb-3 mb-lg-0 me-lg-3">
                        <a href="favoris.php" class="nav-link px-2 link-dark fs-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                            </svg>
                            Mes favoris
                        </a>
                    </ul>

                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                          <?php if (!empty($_SESSION['image'])): ?>
                              <img src="../../images/profil/<?= htmlspecialchars($_SESSION['image']); ?>" alt="Profile Image" width="50" height="50">
                          <?php else: ?>
                              <img src="../../images/profil/default.png" alt="Default Profile Image" width="50" height="50">
                          <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="deconnexion.php">Se déconnecter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>






    <!-- Modal pour renseigner les statistiques -->
    <div class="modal fade" id="statsModal" tabindex="-1" aria-labelledby="statsModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="statsModalLabel">Renseigner vos statistiques</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="statsForm" action="../../controleur/JoueurController.php?action=modifierStatistique" method="post" onsubmit="return validateStats();">
              <div class="mb-3">
                <label for="totalGames" class="form-label">Nombre de parties jouées</label>
                <input type="number" class="form-control" id="totalGames" min="0" name="parties" required>
              </div>
              <div class="mb-3">
                <label for="totalWins" class="form-label">Nombre de victoires</label>
                <input type="number" class="form-control" id="totalWins" min="0" name ="victoires" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary boutona">Soumettre</button>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>



<script>
    function validateStats() {
    var totalGames = document.getElementById('totalGames').value;
    var totalWins = document.getElementById('totalWins').value;

    if (parseInt(totalWins) > parseInt(totalGames)) {
        alert("Le nombre de victoires ne peut pas être supérieur au nombre de parties jouées.");
        return false;
    } else {
        // Soumettez vos données ici ou effectuez des actions supplémentaires
        alert("Statistiques soumises avec succès!");
        $('#statsModal').modal('hide'); // Fermer le modal après la soumission
    }
    }
</script>


