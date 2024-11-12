<?php

class Activites {
    private int $Id;
    private string $Nom;
    private string $description;
    private float $prix;
    private time $heure;
    private date $date;

    public function __construct(int $unId, string $unNom, string $uneDescription, float $unPrix, time $uneHeure, date $uneDate) {
        $this->Id = $unId;
        $this->Nom = $unNom;
        $this->description = $uneDescription;
        $this->prix = $unPrix;
        $this->heure = $uneHeure;
        $this->date = $uneDate;
    }

    public function getId(): int {
        return $this->Id;
    }

    public function setId(int $nouveauId): void {
        $this->Id = $nouveauId;
    }

    public function getNom(): string {
        return $this->Nom;
    }

    public function setNom(string $nouveauNom): void {
        $this->Nom = $nouveauNom;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $nouvelleDescription): void {
        $this->description = $nouvelleDescription;
    }

    public function getPrix(): float {
        return $this->prix;
    }

    public function setPrix(float $nouveauPrix): void {
        $this->prix = $nouveauPrix;
    }
    public function getHeure(): time {
        return $this->heure;
    }
    public function setHeure(time $nouvelleHeure): void {
        $this->heure = $nouvelleHeure;
    }
    public function getDate(): date {
        return $this->date;
    }
    public function setDate(date $nouvelleDate): void {
        $this->date = $nouvelleDate;
    }

    public static function getActivites() {
        include "bd.php";
        $requete = "SELECT * FROM activites";
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function ajouterActivite() {
        include "bd.php";
        $requete = "INSERT INTO activites (nom, description, prix) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
    }

    public static function modifierActivite() {
        include "bd.php";
        $requete = "UPDATE activites SET nom = ?, description = ?, prix = ?, heure = ?, date = ? WHERE id = ?";
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
    }

    public static function supprimerActivite() {
        include "bd.php";
        $requete = "DELETE FROM activites WHERE id = ?";
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
    }
}
