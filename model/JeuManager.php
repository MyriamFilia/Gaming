<?php

    require_once "database.php";
    require_once "Jeu.php";

    class JeuManager {
        private $db;
        private $jeux;

        public function __construct($db) {
            $this->db = $db;
            $this->jeux = [];
        }

        public function ajoutJeu($jeu){
            $this->jeux[] = $jeu;
        }

        public function getJeux(){
            return $this->jeux;
        }

        
        public function ajouterJeu($jeu){

            $sql = "INSERT INTO jeux ( nom , image , studio , description , regles , genre , age_min , date_sortie ) VALUES (? , ? , ? , ? , ? , ? , ? , ?)";
            $stm = $this->db->prepare($sql);
            $nom = $jeu->getNom();
            $image = $jeu->getImage();
            $studio = $jeu->getStudio();
            $description = $jeu->getDescription();
            $regles = $jeu->getRegles();
            $genre = $jeu->getGenre();
            $age_min = $jeu->getAgeMin();
            $date_sortie = $jeu->getDateSortie();
            $stm->bind_param("ssssssis", $nom, $image, $studio, $description, $regles, $genre, $age_min, $date_sortie);
            if ($stm->execute()) {
                $stm->close();
                return true;
            } else {
                $stm->close();
                return false;
            }
            
        }

        public function modifierJeu($jeu){

            $sql = "UPDATE jeux SET nom = ? , image = ? , studio = ? , description = ? , regles = ? , genre = ? , age_min = ? , date_sortie = ?  WHERE id_jeu = ?";
            $stm = $this->db->prepare($sql);
            
            $nom = $jeu->getNom();
            $image = $jeu->getImage();
            $studio = $jeu->getStudio();
            $description = $jeu->getDescription();
            $regles = $jeu->getRegles();
            $genre = $jeu->getGenre();
            $age_min = $jeu->getAgeMin();
            $date_sortie = $jeu->getDateSortie();
            $id = $jeu->getIdJeu();

            $stm->bind_param("ssssssisi", $nom, $image, $studio, $description, $regles, $genre, $age_min, $date_sortie, $id );
            $stm->execute();
            $stm->close();
            
            
        }

        public function supprimerJeu($jeu){

            $sql = "DELETE FROM jeux WHERE id_jeu = ?";
            $stm = $this->db->prepare($sql);
            $id = $jeu->getIdJeu();
            $stm->bind_param("i", $id);
            $stm->execute();
            $stm->close();
            
        }

        public function afficherJeux(){
            $sql = "SELECT * FROM jeux";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $lesJeux = $stm->get_result();

            if ($lesJeux) {
                while ($jeu = $lesJeux->fetch_assoc()) {
                    $nouveauJeu = new Jeu();
                    $nouveauJeu->initWithData($jeu['id_jeu'], $jeu['nom'], $jeu['image'], $jeu['studio'], $jeu['description'], $jeu['regles'], $jeu['genre'], $jeu['age_min'], $jeu['date_sortie']);
                    $this->ajoutJeu($nouveauJeu);
                }
            }
        }

        public function afficherUnJeu($id){
            $sql = "SELECT * FROM jeux WHERE id_jeu = ?";
            $stm = $this->db->prepare($sql);
            $stm->bind_param("i", $id);
            $stm->execute();
            $resultat = $stm->get_result();
            if ($jeu = $resultat->fetch_assoc()) {
                $nouveauJeu = new Jeu();
                $nouveauJeu->initWithData($jeu['id_jeu'], $jeu['nom'], $jeu['image'], $jeu['studio'], $jeu['description'], $jeu['regles'], $jeu['genre'], $jeu['age_min'], $jeu['date_sortie']);
                return $nouveauJeu;
            }
            return null;
        }


        public function jeuxLesPlusAimes() {
            $sql = "SELECT jeux.* , AVG(avis.note) AS note_moyenne FROM jeux INNER JOIN avis ON jeux.id_jeu = avis.id_jeu GROUP BY jeux.id_jeu, jeux.nom ORDER BY note_moyenne DESC LIMIT 4";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $result = $stm->get_result();
            $jeuxLesPlusAimes = []; // Création d'un tableau vide pour stocker les jeux
        
            if ($result) {
                while ($jeu = $result->fetch_assoc()) {
                    $nouveauJeu = new Jeu();
                    $nouveauJeu->initWithData($jeu['id_jeu'], $jeu['nom'], $jeu['image'], $jeu['studio'], $jeu['description'], $jeu['regles'], $jeu['genre'], $jeu['age_min'], $jeu['date_sortie']);
                    $jeuxLesPlusAimes[] = $nouveauJeu;
                }
            }
            $stm->close();
            return $jeuxLesPlusAimes; 
        }
        

        public function jeuxEnFavoris () {
            $sql = "SELECT j.* , AVG(a.note) AS note_moyenne
                        FROM jeux j
                        INNER JOIN avis a ON j.id_jeu = a.id_jeu
                        WHERE j.genre IN (
                            SELECT DISTINCT genre
                            FROM jeux
                            WHERE id_jeu IN (
                                SELECT id_jeu
                                FROM favoris
                                WHERE id_joueur = ?
                            )
                        )
                        AND j.id_jeu NOT IN (
                            SELECT id_jeu
                            FROM favoris
                            WHERE id_joueur = ?
                        )
                        GROUP BY j.id_jeu, j.nom, j.genre
                        ORDER BY note_moyenne DESC
                        LIMIT 4;
                    ";
            $stm = $this->db->prepare($sql);
            $id_joueur = $_SESSION['user_id'];
            $id_joueur2 = $_SESSION['user_id'];
            $stm->bind_param("ii", $id_joueur, $id_joueur2);
            $stm->execute();
            $lesJeux = $stm->get_result();
            $jeuxEnFavoris = [];
            if ($lesJeux) {
                while ($jeu = $lesJeux->fetch_assoc()) {
                    $nouveauJeu = new Jeu();
                    $nouveauJeu->initWithData($jeu['id_jeu'], $jeu['nom'], $jeu['image'], $jeu['studio'], $jeu['description'], $jeu['regles'], $jeu['genre'], $jeu['age_min'], $jeu['date_sortie']);
                    $jeuxEnFavoris[] = $nouveauJeu;
                }
            }
            $stm->close();
            return $jeuxEnFavoris;
            
        }


        public function genres () {
            $sql = "SELECT DISTINCT genre FROM jeux";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $result = $stm->get_result();
            $genres = [];
            if ($result) {
                while ($genre = $result->fetch_assoc()) {
                    $genres[] = $genre['genre'];
                }
            }
            $stm->close();
            return $genres;
        }
        
        public function chargerJeuxFiltres($genre , $rating) {
            $params = []; 
            $types = "";  
        
            $query = "SELECT jeux.*, AVG(avis.note) as note_moyenne
                    FROM jeux
                    LEFT JOIN avis ON jeux.id_jeu = avis.id_jeu
                    WHERE 1=1";
        
            if ($genre != '') {
                $query .= " AND jeux.genre = ?";
                $params[] = $genre;
                $types .= "s"; // 's' pour string
            }
        
            if ($rating != '') {
                $query .= " GROUP BY jeux.id_jeu HAVING AVG(avis.note) >= ?";
                $params[] = (int) $rating;
                $types .= "d"; 
            }
        
            $stmt = $this->db->prepare($query);
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }
        
            $stmt->execute();
            $result = $stmt->get_result();
        
            $jeux = [];
            while ($jeu = $result->fetch_assoc()) {
                $nouveauJeu = new Jeu();
                $nouveauJeu->initWithData($jeu['id_jeu'], $jeu['nom'], $jeu['image'], $jeu['studio'], $jeu['description'], $jeu['regles'], $jeu['genre'], $jeu['age_min'], $jeu['date_sortie'], $jeu['note_moyenne']);
                $jeux[] = $nouveauJeu;
            }
        
            return $jeux;
        }
        
        
       

        
    
    
    }