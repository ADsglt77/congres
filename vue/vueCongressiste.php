<?php

class Accompagnant {
    private $id;
    private $pdo;

    public function __construct($id = null, $pdo = null) {
        if ($id && $pdo) {
            $this->id = $id;
            $this->pdo = $pdo;
        }
    }

    // Méthode pour récupérer tous les accompagnants
    public function getTousAccompagnants() {
        $sql = "SELECT * FROM accompagnants";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Méthode pour récupérer les activités inscrites de l'accompagnant
    public function getActivitesInscrites($id) {
        $sql = "SELECT * FROM activites WHERE id IN (SELECT id_activite FROM inscriptions WHERE id_accompagnant = :id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Méthode d'inscription à une activité
    public function inscrireActivite($idActivite, $idCongressiste) {
        // Ajouter l'accompagnant à l'activité
        $sql = "INSERT INTO inscriptions (id_activite, id_congressiste, id_accompagnant) VALUES (:id_activite, :id_congressiste, :id_accompagnant)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id_activite' => $idActivite,
            'id_congressiste' => $idCongressiste,
            'id_accompagnant' => $this->id
        ]);
    }

    // Méthode de désinscription d'une activité
    public function annulerInscription($idActivite) {
        $sql = "DELETE FROM inscriptions WHERE id_activite = :id_activite AND id_accompagnant = :id_accompagnant";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id_activite' => $idActivite,
            'id_accompagnant' => $this->id
        ]);
    }

    // Getter pour l'ID
    public function getId() {
        return $this->id;
    }

    // Setter pour l'ID
    public function setId($id) {
        $this->id = $id;
    }
}
