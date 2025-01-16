<?php
class CoursTag {
    private $id;
    private $coursId;
    private $tagId;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCoursId() {
        return $this->coursId;
    }

    public function setCoursId($coursId) {
        $this->coursId = $coursId;
    }

    public function getTagId() {
        return $this->tagId;
    }

    public function setTagId($tagId) {
        $this->tagId = $tagId;
    }
}

?>