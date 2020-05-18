<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
    class Discipline{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function getDisciplines(){
            $this->db->query("SELECT * FROM disciplines");

            $results = $this->db->resultSet();

            return $results;
        }

        public function getDisciplineById($id){
            $this->db->query("SELECT * FROM disciplines WHERE id = :id");
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        public function addDiscipline($data){
                $this->db->query("INSERT INTO disciplines (
                disciplineNameBg
                ,disciplineNameEng
                ,category
                ,professor
                ,semester
                ,elective
                ,credits
                ,annotation
                ,prerequisites
                ,expectations
                )
                VALUES (
                :disciplineNameBg,
                :disciplineNameEng,
                :category,
                :professor,
                :semester,
                :elective,
                :credits,
                :annotation,
                :prerequisites,
                :expectations)");

                $this->db->bind(':disciplineNameBg', $data['disciplineNameBg']);
                $this->db->bind(':disciplineNameEng', $data['disciplineNameEng']);
                $this->db->bind(':category', $data['category']);
                $this->db->bind(':professor', $data['professor']);
                $this->db->bind(':semester', $data['semester']);
                $this->db->bind(':elective', $data['elective']);
                $this->db->bind(':credits', $data['credits']);
                $this->db->bind(':annotation', $data['annotation']);
                $this->db->bind(':prerequisites', $data['prerequisites']);
                $this->db->bind(':expectations', $data['expectations']);
                //TODO : figure out how to store synopsis and bibliography - ?speratae tables /as contents will be?*/
                /*$this->db->bind(':synopsis', $data['synopsis']);
                $this->db->bind(':bibliography', $data['bibliography']);*/
            
                // Execute
                if($this->db->execute()){
                    return true;
                } else {
                    echo "fail";
                    return false;
                }
        }

        public function addDisciplineForCurriculum($data){
            $this->db->query("INSERT IGNORE INTO `curriculum_disciplines` (disciplineId, curriculumId)
            VALUES (:disciplineId, :curriculumId)");

            $this->db->bind(':disciplineId', $data['disciplineId']);
            $this->db->bind(':curriculumId', $data['curriculumId']);
            

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
    }

        public function getLastInserted(){
            $id = $this->db->getLastInsertedId();
            return $id;
          }
    }
?>