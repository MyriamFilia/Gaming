<?php

    class Favoris {

        private $id_joueur;
        private $id_jeu;

        // Constructeur "vide"
        public function __construct() {
        }

    
        // Constructeur plein pour initialiser directement les attributs
        public function initWithData($id_joueur, $id_jeu) {
            $this->id_joueur = $id_joueur;
            $this->id_jeu = $id_jeu;
            }
        
        // Getters
        public function getIdJoueur() {
            return $this->id_joueur;
        }
        
        public function getIdJeu() {
            return $this->id_jeu;
        }
        
            // Setters
        public function setIdJoueur($id_joueur) {
            $this->id_joueur = $id_joueur;
        }
        
        public function setIdJeu($id_jeu) {
                $this->id_jeu = $id_jeu;
        }
        
        
    }