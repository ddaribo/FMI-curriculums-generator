<?php
    class Curriculum{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function getCurriculums(){
            $this->db->query("SELECT * FROM curriculums");

            $results = $this->db->resultSet();

            return $results;
        }

        public function addCurriculum($data){
                $this->db->query("INSERT IGNORE INTO `curriculums` (oks, specialty, academicYear)
                VALUES (:oks, :specialty, :academicYear)");

                $this->db->bind(':oks', $data['oks']);
                $this->db->bind(':specialty', $data['specialty']);
                $this->db->bind(':academicYear', $data['academicYear']);
                
    
                // Execute
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
        }

        public function getCurriculumByNameAndYear($data){
            $this->db->query("SELECT id FROM `curriculums` WHERE specialty = :specialty AND academicYear= :academicYear");

            $this->db->bind(':specialty', $data['specialty']);
            $this->db->bind(':academicYear', $data['academicYear']);
            
            $result = $this->db->single();
            return $result;
    }

        public function getLastInserted(){
            $id = $this->db->getLastInsertedId();
            return $id;
          }
    }
?>