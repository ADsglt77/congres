<?php

class Congressistes {
    private int $Id;
    private string $Nom;

    public function __construct(int $unId, string $unNom) {
        $this->Id = $unId;
        $this->Nom = $unNom;
    }

    public function getId(): int {
        return $this->Id;
    }
    
    public function getNom(): string {
        return $this->Nom;
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