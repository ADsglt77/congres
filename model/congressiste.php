<?php

class Congressiste {
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

    // Méthodes pour interagir avec la base de données
    public function getTousCongressistes() {
        include "bd.php";
        $req = "SELECT * FROM congressiste";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $lesCongressistes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $lesCongressistes;
    }
    public function getToutesActivites() {
        include "bd.php";
        $req = "SELECT * FROM activite";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function inscrireActivite(int $idActivite): bool {
        include "bd.php";

        // Vérifier si une facture existe
        $reqFacture = "SELECT * FROM facture WHERE id_congressiste = ?";
        $stmt = $pdo->prepare($reqFacture);
        $stmt->bindValue(1, $this->Id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false; // Facture existante
        }










        // Vérifier si le congressiste est déjà inscrit
        $reqInscription = "SELECT * FROM participer_activite WHERE id_congressiste = ? AND id_activite = ?";
        $stmt = $pdo->prepare($reqInscription);
        $stmt->bindValue(1, $this->Id);
        $stmt->bindValue(2, $idActivite);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false; // Déjà inscrit
        }

        // Ajouter l'inscription
        $reqAjout = "INSERT INTO participer_activite (id_congressiste, id_activite) VALUES (?, ?)";
        $stmt = $pdo->prepare($reqAjout);
        $stmt->bindValue(1, $this->Id);
        $stmt->bindValue(2, $idActivite);
        return $stmt->execute();
    }

    public function annulerInscription(int $idActivite): bool {
        include "bd.php";

        // Vérifier si une facture existe
        $reqFacture = "SELECT * FROM facture WHERE id_congressiste = ?";
        $stmt = $pdo->prepare($reqFacture);
        $stmt->bindValue(1, $this->Id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false; // Facture existante
        }

        // Supprimer l'inscription
        $reqSuppression = "DELETE FROM participer_activite WHERE id_congressiste = ? AND id_activite = ?";
        $stmt = $pdo->prepare($reqSuppression);
        $stmt->bindValue(1, $this->Id);
        $stmt->bindValue(2, $idActivite);
        return $stmt->execute();
    }
    function getInscritsPourActivite($id_activite) {
        global $pdo; // Si tu utilises une connexion PDO globale, sinon adapte cette ligne
    
        // Requête SQL pour récupérer les inscrits à une activité spécifique
        $sql = "SELECT c.nom_congressiste, a.nom AS nom_activite, c.id AS id_congressiste
                FROM congressiste c
                JOIN participer_activite pa ON c.id = pa.id_congressiste
                JOIN activite a ON pa.id_activite = a.id
                WHERE a.id = ?";
        
        // Préparation et exécution de la requête
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_activite]);
        
        // Retourner les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>




