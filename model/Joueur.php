<?php

    class Joueur {
        
        private $id_joueur;
        private $pseudo;
        private $mot_de_passe ;
        private $pays ;
        private $role ;
        private $img_profil ;
        private $nb_parties ;
        private $nb_victoires;
        private $date_inscription ;
        private $date_modification;
        private $date_derniere_connexion;


        // Constructeur vide
        public function __construct() {}


        public function initWithData($id_joueur, $pseudo, $mot_de_passe, $pays, $role, $img_profil, $nb_parties, $nb_victoires, $date_inscription, $date_modification, $date_derniere_connexion) {
            $this->id_joueur = $id_joueur;
            $this->pseudo = $pseudo;
            $this->mot_de_passe = $mot_de_passe;
            $this->pays = $pays;
            $this->role = $role;
            $this->img_profil = $img_profil;
            $this->nb_parties = $nb_parties;
            $this->nb_victoires = $nb_victoires;
            $this->date_inscription = $date_inscription;
            $this->date_modification = $date_modification;
            $this->date_derniere_connexion = $date_derniere_connexion;
        }

        // Getters
        public function getIdJoueur() {
            return $this->id_joueur;
        }

        public function getPseudo() {
            return $this->pseudo;
        }

        public function getMotDePasse() {
            return $this->mot_de_passe;
        }

        public function getPays() {
            return $this->pays;
        }

        public function getRole() {
            return $this->role;
        }

        public function getImgProfil() {
            return $this->img_profil;
        }

        public function getNbParties() {
            return $this->nb_parties;
        }

        public function getNbVictoires() {
            return $this->nb_victoires;
        }

        public function getDateInscription() {
            return $this->date_inscription;
        }

        public function getDateModification() {
            return $this->date_modification;
        }

        public function getDateDerniereConnexion() {
            return $this->date_derniere_connexion;
        }

        // Setters
        public function setIdJoueur($id_joueur) {
            $this->id_joueur = $id_joueur;
        }

        public function setPseudo($pseudo) {
            $this->pseudo = $pseudo;
        }

        public function setMotDePasse($mot_de_passe) {
            $this->mot_de_passe = $mot_de_passe;
        }

        public function setPays($pays) {
            $this->pays = $pays;
        }

        public function setRole($role) {
            $this->role = $role;
        }

        public function setImgProfil($img_profil) {
            $this->img_profil = $img_profil;
        }

        public function setNbParties($nb_parties) {
            $this->nb_parties = $nb_parties;
        }

        public function setNbVictoires($nb_victoires) {
            $this->nb_victoires = $nb_victoires;
        }

        public function setDateInscription($date_inscription) {
            $this->date_inscription = $date_inscription;
        }

        public function setDateModification($date_modification) {
            $this->date_modification = $date_modification;
        }

        public function setDateDerniereConnexion($date_derniere_connexion) {
            $this->date_derniere_connexion = $date_derniere_connexion;
        }
    }


        