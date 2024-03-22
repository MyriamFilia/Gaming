<?php

    require_once "database.php";
    require_once "Joueur.php";

    class JoueurManager {
        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        public function ajouterJoueur($joueur){
            $sql = "INSERT INTO joueurs (pseudo, mot_de_passe, pays) VALUES (?, ?, ?)";
            $sth = $this->db->prepare($sql);
            $pseudo = $joueur->getPseudo();
            $motDePasse = $joueur->getMotDePasse();
            $pays = $joueur->getPays();
            $sth->bind_param("sss", $pseudo, $motDePasse, $pays);
            $sth->execute();
            $sth->close();
        }

        public function retrouverJoueur($pseudo, $motDePasse) {
            $sql = "SELECT * FROM joueurs WHERE pseudo = ?";
            $stm = $this->db->prepare($sql);
            $stm->bind_param("s", $pseudo);
            $stm->execute();
            $result = $stm->get_result();
            
            if ($result->num_rows == 1) {
                $donneesJoueur = $result->fetch_assoc();
                if (password_verify($motDePasse, $donneesJoueur['mot_de_passe'])) {
                    return [
                        'role' => $donneesJoueur['role'],
                        'id' => $donneesJoueur['id_joueur'],
                        'pseudo' => $donneesJoueur['pseudo'],
                        'image' => $donneesJoueur['img_profil'],
                        
                    ];
                }
            }
            return false;
            $stm->close();
        }

        public function retrouverJoueurId($idJoueur) {
            $sql = "SELECT * FROM joueurs WHERE id_joueur = ?";
            $stm = $this->db->prepare($sql);
            $stm->bind_param("i", $idJoueur);
            $stm->execute();
            $result = $stm->get_result();
            
            if ($result->num_rows >0) {
                $donneesJoueur = $result->fetch_assoc();
                return $donneesJoueur;
            } else {
                return null;
            }
            $stm->close();
        }

        public function mettreAJourDerniereConnexion($idJoueur) {
            $sql = "UPDATE joueurs SET date_derniere_connexion = NOW() WHERE id_joueur = ?";
            $stm = $this->db->prepare($sql);
            $stm->bind_param("i", $idJoueur);
            $stm->execute();
            $stm->close();
        }

        public function modifierMotdePasse($joueur) {  
            $sql = "UPDATE joueurs SET mot_de_passe = ?, date_modification = NOW() WHERE id_joueur = ?";
            $sth = $this->db->prepare($sql);
            $motDePasseHash = password_hash($joueur->getMotDePasse(), PASSWORD_DEFAULT);
            $id = $joueur->getIdJoueur(); 
            $sth->bind_param("si", $motDePasseHash, $id);
            $sth->execute();
            $sth->close();
        }


        public function modifierStatistiques($idJoueur, $nbParties, $nbVictoires) {
            $sql = "UPDATE joueurs SET nb_parties = ?, nb_victoires = ? WHERE id_joueur = ?";
            $sth = $this->db->prepare($sql);
            $sth->bind_param("iii", $nbParties, $nbVictoires, $idJoueur);
            $sth->execute();
            $sth->close();
        }
        


        public function modifierPseudo($idJoueur , $nouveauPseudo) {
            $sql = "UPDATE joueurs SET pseudo = ? WHERE id_joueur = ?";
            $sth = $this->db->prepare($sql);
            $sth->bind_param("si", $nouveauPseudo, $idJoueur);
            $sth->execute();
            $sth->close();
        }

        public function modifierImageProfil($idJoueur, $nouvelleImage) {
            $sql = "UPDATE joueurs SET img_profil = ? WHERE id_joueur = ?";
            $sth = $this->db->prepare($sql);
            $sth->bind_param("si", $nouvelleImage, $idJoueur);
            $sth->execute();
            $sth->close();
        }


        public function statistiques() {
            $sql = "SELECT *, (CASE WHEN nb_parties > 0 THEN nb_victoires / nb_parties ELSE 0 END) AS taux_victoire
                    FROM joueurs
                    WHERE role != 'admin'
                    ORDER BY 
                        nb_parties > 0 DESC,
                        taux_victoire DESC, 
                        nb_parties DESC;
                    ";
            $result = $this->db->query($sql);     
            $joueurs = [];
            $rang = 1;
            while ($row = $result->fetch_assoc()) {
                $row['rang'] = $rang++;
                $joueurs[] = $row;
            }
            return $joueurs;
        }


        public function getRangJoueur($joueurId) {
            $joueurs = $this->statistiques();
            $rang = 1;
            foreach ($joueurs as $joueur) {
                if ($joueur['id_joueur'] == $joueurId) {
                    return $rang; 
                }
                $rang++;
            }
            return null;
        }
        
        
        


       
    
        

    }