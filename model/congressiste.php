<?php

class Congressistes {
    private int $Id;
    private string $Nom;
    private array $Activites; // Tableau d'objets de type Activite

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

    // Méthode pour ajouter une activité à la liste
    public function ajouterActivite(Activite $activite): void {
        $this->Activites[] = $activite; // Ajoute l'activité à la fin du tableau
    }
}

?>
