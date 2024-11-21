<?php

class Congressistes {
    private int $Id;
    private string $Nom;
    private array $Activites; // Utilisation d'un tableau pour stocker plusieurs activités

    public function __construct(int $unId, string $unNom, array $desActivites) {
        $this->Id = $unId;
        $this->Nom = $unNom;
        $this->Activites = $desActivites; // Stockage des activités dans un tableau
    }

    public function getId(): int {
        return $this->Id;
    }
    
    public function getNom(): string {
        return $this->Nom;
    }

    public function getActivites(): array {
        return $this->Activites;
    }

    // Ajout d'une méthode pour ajouter une activité à la liste
    public function ajouterActivite(Activites $activite): void {
        $this->Activites[] = $activite;
    }

    public static function getCongressistes() {
        include "bd.php";
        $requete = "SELECT * FROM congressiste";
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $congressistes = [];
        foreach ($resultats as $row) {
            // Récupérer les activités pour chaque congressiste
            $requeteActivites = "SELECT * FROM activites WHERE congressiste_id = :id";
            $stmtActivites = $pdo->prepare($requeteActivites);
            $stmtActivites->execute(['id' => $row['id']]);
            $activites = $stmtActivites->fetchAll(PDO::FETCH_ASSOC);

            // Créer des objets Activites
            $listeActivites = [];
            foreach ($activites as $activite) {
                $listeActivites[] = new Activites($activite['id'], $activite['nom'], $activite['description']);
            }

            // Créer l'objet Congressiste
            $congressistes[] = new Congressistes($row['id'], $row['nom'], $listeActivites);
        }

        return $congressistes;
    }
}

?>
