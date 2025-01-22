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

    public function recupererCoursParId($id) {
        try {
            // Requête SQL pour récupérer les informations d'un cours
            $stmt = $this->db->prepare("SELECT * FROM cours WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            // Retourner les résultats sous forme de tableau associatif
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer les erreurs de la base de données
            die("Erreur : " . $e->getMessage());
        }
    }
    
 }
?>
