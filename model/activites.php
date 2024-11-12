// model/Activites.php
<?php

class Activites {
    private int $Id;
    private string $Nom;
    private string $description;
    private float $prix; // Utiliser float au lieu de decimal

    public function __construct(int $unId, string $unNom, string $uneDescription, float $unPrix) {
        $this->Id = $unId;
        $this->Nom = $unNom;
        $this->description = $uneDescription;
        $this->prix = $unPrix;
    }

    // Getters et Setters
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

    // Méthodes pour manipuler les activités
    public static function getActivites() {
        include "bd.php";
        $requete = "SELECT * FROM activites";
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getActivite() {
        include "bd.php";
        $requete = "SELECT * FROM activites WHERE id = ?";
        $stmt = $pdo->prepare($requete);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function ajouterActivite() {
        include "bd.php";
        $requete = "INSERT INTO activites (nom, description, prix) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
    }

    public static function modifierActivite() {
        include "bd.php";
        $requete = "UPDATE activites SET nom = ?, description = ?, prix = ? WHERE id = ?";
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
