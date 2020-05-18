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

        /*function manageDiscipline(){
            global $phpInput;
            $disciplineJson = json_decode($phpInput['discipline'], true);
            $contentJson = json_decode($phpInput['content'], true);
        
            require_once "./entities/discipline.php";
            require_once "./entities/content.php";
            require_once "./entities/curriculum.php";
        
            $curriculumIds = array();
        
            $oks=$disciplineJson['oks'];
            $specialties=$disciplineJson['specialties'];
            $academicYear=$disciplineJson['academicYear'];
                foreach($specialties as $specialtyName){
                    print_r($specialtyName); echo "<br>";
                    $curriculum = new Curriculum($oks, $specialtyName, $academicYear);
                    $curriculum->storeCurriculumInDb();
                    $curriculumIds[] = $curriculum->getCurriculumId($specialtyName, $academicYear);
                
                }
            print_r($curriculumIds);
        
            /*Some fields can be NULL in the DB. In php, we get notices when some of these indexes are missing. Storing in DB still works */
            /*$disciplineNameBg = $disciplineJson['disciplineNameBg'];
            $disciplineNameEng = $disciplineJson['disciplineNameEng'];
            $professor = $disciplineJson['professor'];
            $elective = (boolean)$disciplineJson['elective'];
            $credits = $disciplineJson['credits'];
            $annotation =  $disciplineJson['annotation'];
            $prerequisites = $disciplineJson['prerequisites'];
            $expectations = $disciplineJson['expectations'];
            $synopsis = $disciplineJson['synopsis'];
            $bibliography = $disciplineJson['bibliography'];
        
            $discipline = new Discipline($disciplineNameBg,
            $disciplineNameEng,
            $professor,
            $elective,
            $credits,
            $annotation,
            $prerequisites,
            $expectations,
            $synopsis,
            $bibliography);
        
            try {
                $insertedDisciplineid = $discipline->storeDisciplineInDb();
                if($contentJson){
                    echo json_encode($insertedDisciplineid);
                    foreach($contentJson as $topic => $topicNames){
                        foreach($topicNames as $topicName){
                            print_r($topicName); echo "<br>";
                            $content = new Content($insertedDisciplineid, $topicName);
                            $content->storeContentInDb();
                        }
                    }
                }
        
                foreach($curriculumIds as $curriculumId){
                    print_r($curriculumId);
                    $discipline->storeDisciplinesByCurriculum($curriculumId, $insertedDisciplineid);
                }
        
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage(),
                ]);
            }
        }*/

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

                
                /*echo $data['disciplineNameBg'];
                echo $data['disciplineNameEng'];
                echo  $data['category'];
                echo $data['professor'];
                echo  $data['semester'];
                echo  $data['elective'];
                echo $data['credits'];
                echo $data['annotation'];
                echo $data['prerequisites'];
                echo $data['expectations'];*/

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