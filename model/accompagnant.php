<?php

class Accompagnant {
    private int $Id;
    private string $Nom;
    private string $Prenom;
    private string $Adresse;

    public function __construct() {}

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

    public function getPrenom(): string {
        return $this->Prenom;
    }

    public function setPrenom(string $nouveauPrenom): void {
        $this->Prenom = $nouveauPrenom;
    }

    public function getAdresse(): string {
        return $this->Adresse;
    }

    public function setAdresse(string $nouvelleAdresse): void {
        $this->Adresse = $nouvelleAdresse;
    }

    // Récupérer un accompagnant par son ID
    public function getAccompagnantById(int $id) {
        include "bd.php";
        $req = "SELECT * FROM accompagnant WHERE id = ?";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Récupérer les activités auxquelles un accompagnant est inscrit
    public function getActivitesInscrites(int $idAccompagnant) {
        include "bd.php";
        $req = "SELECT id_activite FROM participer_activite WHERE id_accompagnant = ?";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(1, $idAccompagnant);
        $stmt->execute();
        $activitesInscrites = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $activitesInscrites;
    }

    // Récupérer tous les accompagnants
    public function getTousAccompagnants() {
        include "bd.php";
        $req = "SELECT * FROM accompagnant";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $lesAccompagnants = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $lesAccompagnants;
    }

    // Inscrire un accompagnant à une activité
    public function inscrireActivite(int $idActivite, int $idCongressiste): bool {
        include "bd.php";
        // Vérifier si le congressiste est déjà inscrit à l'activité
        $reqVerifCongressiste = "SELECT * FROM participer_activite WHERE id_congressiste = ? AND id_activite = ?";
        $stmt = $pdo->prepare($reqVerifCongressiste);
        $stmt->bindValue(1, $idCongressiste, PDO::PARAM_INT);
        $stmt->bindValue(2, $idActivite, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return false; // Le congressiste n'est pas inscrit à l'activité
        }

        // Vérifier si l'accompagnant est déjà inscrit à l'activité
        $reqDejaInscrit = "SELECT * FROM participer_activite WHERE id_accompagnant = ? AND id_activite = ?";
        $stmt = $pdo->prepare($reqDejaInscrit);
        $stmt->bindValue(1, $this->Id, PDO::PARAM_INT);
        $stmt->bindValue(2, $idActivite, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false; // Accompagnant déjà inscrit à l'activité
        }

        // Inscrire l'accompagnant à l'activité
        $reqAjout = "INSERT INTO participer_activite (id_accompagnant, id_activite) VALUES (?, ?)";
        $stmt = $pdo->prepare($reqAjout);
        $stmt->bindValue(1, $this->Id, PDO::PARAM_INT);
        $stmt->bindValue(2, $idActivite, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Annuler l'inscription d'un accompagnant à une activité
    public function annulerInscription(int $idActivite): bool {
        include "bd.php";
        // Supprimer l'inscription
        $reqSuppression = "DELETE FROM participer_activite WHERE id_accompagnant = ? AND id_activite = ?";
        $stmt = $pdo->prepare($reqSuppression);
        $stmt->bindValue(1, $this->Id, PDO::PARAM_INT);
        $stmt->bindValue(2, $idActivite, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Récupérer toutes les activités disponibles
    public function getToutesActivites() {
        include "bd.php";
        $req = "SELECT * FROM activite";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
