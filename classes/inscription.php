<?php
class Inscription {
    private $id;
    private $etudiantId;
    private $coursId;
    private $dateInscription;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEtudiantId() {
        return $this->etudiantId;
    }

    public function setEtudiantId($etudiantId) {
        $this->etudiantId = $etudiantId;
    }

    public function getCoursId() {
        return $this->coursId;
    }

    public function setCoursId($coursId) {
        $this->coursId = $coursId;
    }

    public function getDateInscription() {
        return $this->dateInscription;
    }

    public function setDateInscription($dateInscription) {
        $this->dateInscription = $dateInscription;
    }
}
?>