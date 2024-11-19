<?php

class Congressistes {
    private int $Id;
    private string $Nom;
    private Activites $activites;

    public function __construct(int $unId, string $unNom, Activites $uneActivite) {
        $this->Id = $unId;
        $this->Nom = $unNom;
        $this->Activites = $uneActivite;
    }

    public function getId(): int {
        return $this->Id;
    }
    
    public function getNom(): string {
        return $this->Nom;
    }

    public function getActivites(): Activites {
        return $this->Activites;
    }

    public static function getcongressiste(){
        include "bd.php";
        $requete = "SELECT * FROM congressiste";
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>