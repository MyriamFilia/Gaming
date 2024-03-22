<?php
    
    require_once "database.php";
    require_once "Jeu.php";
    require_once "Joueur.php";
    require_once "Favoris.php";

    class FavorisManager {
        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        public function estDejaFavori($idJoueur, $idJeu) {
            $sql = "SELECT COUNT(*) FROM favoris WHERE id_joueur = ? AND id_jeu = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ii", $idJoueur, $idJeu);
            $stmt->execute();
            $result = $stmt->get_result();
            $nombre = $result->fetch_row()[0];
            $stmt->close();
        
            return $nombre > 0;
        }


        public function ajouterFavoris( $joueur , $jeu ){
            $sql = "INSERT IGNORE INTO favoris (id_joueur, id_jeu) VALUES (?,?)";
            $sth = $this->db->prepare($sql);
            $sth->bind_param("ii", $joueur , $jeu);
            $sth->execute();
            $sth->close();
        }

        public function supprimerFavoris($jeu , $joueur){
            $sql = "DELETE FROM favoris WHERE id_jeu =? AND id_joueur =?";
            $sth = $this->db->prepare($sql);
            $sth->bind_param("ii",  $joueur,$jeu);
            $sth->execute();
            $sth->close();
        }

        public function afficherFavorisJoueur(){
            $sql = "SELECT jeux.* FROM jeux
                    INNER JOIN favoris ON jeux.id_jeu = favoris.id_jeu
                    WHERE favoris.id_joueur = ?";
            $sth = $this->db->prepare($sql);
            $id_joueur = $_SESSION['user_id'];
            $sth->bind_param("i", $id_joueur);
            $sth->execute();
            $lesJeux = $sth->get_result();
            $jeuxFavoris = [];
            if ($lesJeux){
                while ($jeu = $lesJeux->fetch_assoc()) {
                    $nouveauJeu = new Jeu();
                    $nouveauJeu->initWithData($jeu['id_jeu'], $jeu['nom'], $jeu['image'], $jeu['studio'], $jeu['description'], $jeu['regles'], $jeu['genre'], $jeu['age_min'], $jeu['date_sortie']);
                    $jeuxFavoris[] = $nouveauJeu;
                }
            }
            $sth->close();
            return $jeuxFavoris;
        }


        public function afficherToutFavoris() {
            $sql = "SELECT jeux.* FROM jeux
                    INNER JOIN favoris ON jeux.id_jeu = favoris.id_jeu";
            $sth = $this->db->prepare($sql);
            $sth->execute();
            $lesJeux = $sth->get_result();
            $jeuxFavoris = [];
            if ($lesJeux){
                while ($jeu = $lesJeux->fetch_assoc()) {
                    $nouveauJeu = new Jeu();
                    $nouveauJeu->initWithData($jeu['id_jeu'], $jeu['nom'], $jeu['image'], $jeu['studio'], $jeu['description'], $jeu['regles'], $jeu['genre'], $jeu['age_min'], $jeu['date_sortie']);
                    $jeuxFavoris[] = $nouveauJeu;
                }
            }
            $sth->close();
            return $jeuxFavoris;
    
        }

        


    }