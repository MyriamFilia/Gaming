<?php
    
    require_once "database.php";
    require_once "Jeu.php";
    require_once "Joueur.php";
    require_once "Avis.php";

    class AvisManager {
        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        public function notedunJeu($idJeu) {
            $sql = "SELECT AVG(note) as noteMoyenne FROM avis WHERE id_jeu = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $idJeu);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            $moyenne = $result['noteMoyenne'];
            if (is_null($moyenne)) {
                return 5;
            }
            return round($moyenne, 1);

        }

        public function noteExiste($idJeu, $idJoueur) {
            $sql = "SELECT id_avis FROM avis WHERE id_jeu = ? AND id_joueur = ? AND note IS NOT NULL";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ii", $idJeu, $idJoueur);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result->num_rows > 0;
        }



        public function ajouterAvis($idJeu, $idJoueur, $note , $commentaire){
            $sql = "INSERT INTO avis (id_jeu, id_joueur, note, commentaire, date_publication) VALUES (?, ?, ?, ?,NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iiis", $idJeu, $idJoueur, $note, $commentaire);
            $stmt->execute();
            $stmt->close();
        }
        
        

        public function afficherCommentaires($idJeu){
            $sql = "SELECT commentaire, date_publication, pseudo, img_profil
                    FROM avis
                    INNER JOIN joueurs ON avis.id_joueur = joueurs.id_joueur
                    WHERE avis.id_jeu = ?
                    ORDER BY date_publication DESC";
        
            $sth = $this->db->prepare($sql);
            $sth->bind_param("i", $idJeu);
            $sth->execute();
            $resultat = $sth->get_result();
            $lesCommentaires = [];
            if ($resultat) {
                while ($commentaire = $resultat->fetch_assoc()) {
                    $lesCommentaires[] = $commentaire;
                }
            }
            $sth->close();
            return $lesCommentaires;
        }
        
        
    }