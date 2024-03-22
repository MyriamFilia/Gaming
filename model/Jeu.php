<?php

    class Jeu {

        private $id_jeu ;
        private $nom;
        private $image;
        private $studio;
        private $description;
        private $regles;
        private $genre;
        private $age_min;
        private $date_sortie;


        // Constructeur "vide"
        public function __construct() {
        }

        public function initWithData($id_jeu = null, $nom = null, $image = null, $studio = null, $description = null, $regles = null, $genre = null, $age_min = null, $date_sortie = null) {
            $this->id_jeu = $id_jeu;
            $this->nom = $nom;
            $this->image = $image;
            $this->studio = $studio;
            $this->description = $description;
            $this->regles = $regles;
            $this->genre = $genre;
            $this->age_min = $age_min;
            $this->date_sortie = $date_sortie;
        }

        // Getters
        public function getIdJeu() {
            return $this->id_jeu;
        }

        public function getNom() {
            return $this->nom;
        }

        public function getImage() {
            return $this->image;
        }

        public function getStudio() {
            return $this->studio;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getRegles() {
            return $this->regles;
        }

        public function getGenre() {
            return $this->genre;
        }

        public function getAgeMin() {
            return $this->age_min;
        }

        public function getDateSortie() {
            return $this->date_sortie;
        }

        // Setters
        public function setIdJeu($id_jeu) {
            $this->id_jeu = $id_jeu;
        }

        public function setNom($nom) {
            $this->nom = $nom;
        }

        public function setImage($image) {
            $this->image = $image;
        }

        public function setStudio($studio) {
            $this->studio = $studio;
        }

        public function setDescription($description) {
            $this->description = $description;
        }

        public function setRegles($regles) {
            $this->regles = $regles;
        }

        public function setGenre($genre) {
            $this->genre = $genre;
        }

        public function setAgeMin($age_min) {
            $this->age_min = $age_min;
        }

        public function setDateSortie($date_sortie) {
            $this->date_sortie = $date_sortie;
        }
    }