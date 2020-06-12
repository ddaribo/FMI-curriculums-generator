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
                ,oks
                ,professor
                ,semester
                ,elective
                ,credits
                ,annotation
                ,prerequisites
                ,expectations
                ,content
                ,synopsis
                ,bibliography
                )
                VALUES (
                :disciplineNameBg,
                :disciplineNameEng,
                :category,
                :oks,
                :professor,
                :semester,
                :elective,
                :credits,
                :annotation,
                :prerequisites,
                :expectations,
                :content,
                :synopsis,
                :bibliography)");

                $this->db->bind(':disciplineNameBg', $data['disciplineNameBg']);
                $this->db->bind(':disciplineNameEng', $data['disciplineNameEng']);
                $this->db->bind(':category', $data['category']);
                $this->db->bind(':oks', $data['oks']);
                $this->db->bind(':professor', $data['professor']);
                $this->db->bind(':semester', $data['semester']);
                $this->db->bind(':elective', $data['elective']);
                $this->db->bind(':credits', $data['credits']);
                $this->db->bind(':annotation', $data['annotation']);
                $this->db->bind(':prerequisites', $data['prerequisites']);
                $this->db->bind(':expectations', $data['expectations']);
                $this->db->bind(':content', $data['content']);
                $this->db->bind(':synopsis', $data['synopsis']);
                $this->db->bind(':bibliography', $data['bibliography']);
            
                // Execute
                if($this->db->execute()){
                    return true;
                } else {
                    echo "fail";
                    return false;
                }
        }

        public function updateDiscipline($data){
            $this->db->query("UPDATE disciplines SET 
            disciplineNameBg = :disciplineNameBg,
            disciplineNameEng = :disciplineNameEng,
            category = :category,
            oks = :oks,
            professor = :professor,
            semester = :semester,
            elective = :elective,
            credits = :credits,
            annotation = :annotation,
            prerequisites = :prerequisites,
            expectations = :expectations,
            content = :content,
            synopsis = :synopsis,
            bibliography = :bibliography
            WHERE id = :id");

            $this->db->bind(':disciplineNameBg', $data['disciplineNameBg']);
            $this->db->bind(':disciplineNameEng', $data['disciplineNameEng']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':oks', $data['oks']);
            $this->db->bind(':professor', $data['professor']);
            $this->db->bind(':semester', $data['semester']);
            $this->db->bind(':elective', $data['elective']);
            $this->db->bind(':credits', $data['credits']);
            $this->db->bind(':annotation', $data['annotation']);
            $this->db->bind(':prerequisites', $data['prerequisites']);
            $this->db->bind(':expectations', $data['expectations']);
            $this->db->bind(':content', $data['content']);
            $this->db->bind(':synopsis', $data['synopsis']);
            $this->db->bind(':bibliography', $data['bibliography']);
            $this->db->bind(':id', $data['id']);

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

        public function search($field, $searchInput){
            $this->db->query("SELECT * FROM disciplines WHERE $field LIKE '%$searchInput%'");
            
            /*Binding parameters in a query like this is buggy, so we avoid it here in the name of working search functionality */
            /*To assure some security we sanitize $_POST input in the controller search method */

            $results = $this->db->resultSet();

            return $results;
        }

        public function getLastInserted(){
            $id = $this->db->getLastInsertedId();
            return $id;
        }

        /* Before we delete a discipline from the DB we need to delete its occurences in relationships tables */
        public function deleteDisciplineCurriculumRelationship($id){
            $this->db->query('DELETE FROM `curriculum_disciplines` WHERE disciplineId = :id');
            
            $this->db->bind(':id', $id);

            if($this->db->execute()){
               return true;
            } else {
                return false;
            }
        }

        public function deleteDiscipline($id){
            $this->deleteDisciplineCurriculumRelationship($id);
            $this->db->query('DELETE FROM `disciplines` WHERE id = :id');
            
            $this->db->bind(':id', $id);

            if($this->db->execute()){
                $file ="../public/JSONS/file" . $id . ".json";
                if(file_exists($file)) { 
                    if(unlink($file)){
                        return true;
                    }
                }
            } else {
                return false;
            }
            return true;
        }
    }
?>