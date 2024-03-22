
    <div class="card game-card">
        <div class="messageContainer" data-jeu-id="<?= $jeu->getIdJeu(); ?>"></div>
        <div class="favorite-icon">
            <button class="add-to-favorites" data-jeu-id="<?php echo $jeu->getIdJeu(); ?>" style="background: none; border: none; cursor: pointer; padding-right: 5px; font-size: 30px; position: absolute; top: 0; right: 0">
                <i class="fas fa-heart" style="color: red"></i>
            </button>
        </div>
        <img src="../../images/jeux/<?= htmlspecialchars($jeu->getImage()?? '') ?>"  class="card-img-top game-image" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($jeu->getNom()?? '') ?></h5>
            <div class="rating">
            <?php
                require_once '../../model/AvisManager.php';
                $avisManager = new AvisManager($db);
                $noteMoyenne = $avisManager->notedunJeu($jeu->getIdJeu());
                echo '<span class="">Notes: </span>';
                for ($i = 1; $i <= 5; $i++) {
                    if ($noteMoyenne >= $i) {
                        echo '<span class="fa fa-star checked"></span>';
                    } elseif ($noteMoyenne >= ($i - 0.5)) {
                        echo '<span class="fas fa-star-half-alt checked"></span>';
                    } else {
                        echo '<span class="far fa-star"></span>';
                    }
                }
                ?>
            </div>
            <div class="d-flex justify-content-center">
                <a href="detailjeu.php?id=<?= htmlspecialchars($jeu->getIdJeu()) ?>" class="btn btn-primary boutona">Découvrir</a>
            </div>
        </div>
    </div>

