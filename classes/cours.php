<?php
class Cours {
    private $db;
    private $id;
    private $titre;
    private $description;
    private $contenu;
    private $categorie;

    public function __construct() {
        $this->db = (new Database())->connect(); // Connexion à la base de données
    }

    // Getter et Setter pour les propriétés
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    // Ajouter un cours
    // public function ajouterCours($titre, $description, $contenu, $categorie) {
    //     $stmt = $this->db->prepare("INSERT INTO cours (titre, description, contenu, categorie) VALUES (:titre, :description, :contenu, :categorie)");
    //     $stmt->bindParam(':titre', $titre);
    //     $stmt->bindParam(':description', $description);
    //     $stmt->bindParam(':contenu', $contenu);
    //     $stmt->bindParam(':categorie', $categorie);
    //     return $stmt->execute();
    // }

    // // Modifier un cours
    // public function modifierCours($id, $titre, $description, $contenu, $categorie) {
    //     $stmt = $this->db->prepare("UPDATE cours SET titre = :titre, description = :description, contenu = :contenu, categorie = :categorie WHERE id = :id");
    //     $stmt->bindParam(':id', $id);
    //     $stmt->bindParam(':titre', $titre);
    //     $stmt->bindParam(':description', $description);
    //     $stmt->bindParam(':contenu', $contenu);
    //     $stmt->bindParam(':categorie', $categorie);
    //     return $stmt->execute();
    // }

    // // Supprimer un cours
    // public function supprimerCours($id) {
    //     $stmt = $this->db->prepare("DELETE FROM cours WHERE id = :id");
    //     $stmt->bindParam(':id', $id);
    //     return $stmt->execute();
    // }

    // Récupérer tous les cours
//     public function recupererTousLesCours() {
//         $stmt = $this->db->prepare("SELECT * FROM cours");
//         $stmt->execute();
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }

//     // Récupérer un cours par ID
//     public function recupererCoursParId($id) {
//         $stmt = $this->db->prepare("SELECT * FROM cours WHERE id = :id");
//         $stmt->bindParam(':id', $id);
//         $stmt->execute();
//         return $stmt->fetch(PDO::FETCH_ASSOC);
//     }
 }
?>
