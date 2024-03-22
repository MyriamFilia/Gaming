<?php

    class Avis {

        private $id_avis;
        private $note; 
        private $commentaire;
        private $date_publication;
        private $id_joueur;
        private $id_jeu;


        // Constructeur "vide"
        public function __construct() {
        }

        public function initWithData($id_avis, $note, $commentaire, $date_publication, $id_joueur, $id_jeu) {
            $this->id_avis = $id_avis;
            $this->note = $note;
            $this->commentaire = $commentaire;
            $this->date_publication = $date_publication;
            $this->id_joueur = $id_joueur;
            $this->id_jeu = $id_jeu;
        }

        // Getters et setters
        public function getIdAvis() {
            return $this->id_avis;
        }

        public function setIdAvis($id_avis) {
            $this->id_avis = $id_avis;
        }

        public function getNote() {
            return $this->note;
        }

        public function setNote($note) {
            $this->note = $note;
        }

        public function getCommentaire() {
            return $this->commentaire;
        }

        public function setCommentaire($commentaire) {
            $this->commentaire = $commentaire;
        }

        public function getDatePublication() {
            return $this->date_publication;
        }

        public function setDatePublication($date_publication) {
            $this->date_publication = $date_publication;
        }

        public function getIdJoueur() {
            return $this->id_joueur;
        }

        public function setIdJoueur($id_joueur) {
            $this->id_joueur = $id_joueur;
        }

        public function getIdJeu() {
            return $this->id_jeu;
        }

        public function setIdJeu($id_jeu) {
            $this->id_jeu = $id_jeu;
        }
    }
