<?php
    class Disciplines extends Controller{
        public function __construct(){
            /*Remove this is we want guest users to access the disciplines content */
            /*if(!isLoggedIn()){
                redirect('users/login');
            }*/
            
            $this->disciplineModel = $this->model('Discipline');
            $this->curriculumModel = $this->model('Curriculum');
        }

        
        public function index(){
            $disciplines = $this->disciplineModel->getDisciplines();

            $data = [
                'disciplines' => $disciplines
            ];

            $this->view('disciplines/index', $data);
        }


          public function import(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $json = json_decode($_POST['mainInfo'], true);

                $disciplineNameBg = $json['Дисциплина'];
                $disciplineNameEng = $json['Discipline'];
                $category = $json['Категория'];
                $professor = $json['Преподавател'];
                $semester = $json['Семестър'];
                $elective = $json['Статут'];
                $credits = $json['Кредити'];
                $annotation =  $json['Анотация'];
                $prerequisites = $json['Предварителни изисквания'];
                $expectations = $json['Очаквани резултати'];
               /* $synopsis = $json['Конспект'];
                $bibliography = $json['Библиография'];*/

                
                $data = [
                    'disciplineNameBg' => $disciplineNameBg,
                    'disciplineNameEng' => $disciplineNameEng,
                    'category' => $category,
                    'professor' => $professor,
                    'semester' => $semester,
                    'elective' => $elective,
                    'credits' => $credits,
                    'annotation' => $annotation,
                    'prerequisites' => $prerequisites,
                    'expectations' => $expectations,
                    /*'synopsis' => $synopsis,
                    'bibliography' => $bibliography, */
                    'mainInfo_err' => ''
                ];

                $storedCurriculumIds = [];

                $specialties = [];
                foreach($json['Специалности'] as $specialty){
                  $specialties[] = $specialty;
                }
                //add oks
                $years = [];
                foreach($json['Академични години'] as $year){
                  $years[] = $year;
                }
                foreach($specialties as $specialty){
                  foreach($years as $year){

                    $curriculumdata = [
                      'specialty' => $specialty,
                      'academicYear' => $year,
                  ];
                  $this->curriculumModel->addCurriculum($curriculumdata);
                  $returnedCurriculumIdsObjects[] =  $this->curriculumModel->getCurriculumByNameAndYear($curriculumdata);
                  }
                }
                $storedCurriculumIds = [];
                foreach($returnedCurriculumIdsObjects as $cid => $value){
                  $storedCurriculumIds[] = $value->id;
                }

                
                //$this->disciplineModel->addDiscipline($data);
                  // Validate data
                  if(empty($data['mainInfo'])){
                    $data['mainInfo_err'] = 'Please enter main info';
                  }
          
                  // Make sure no errors
                 
                    if($this->disciplineModel->addDiscipline($data)){
                      
                      $id = $this->disciplineModel->getLastInserted();

                      foreach($storedCurriculumIds as $cid){
                        $dcdata = [
                          'disciplineId' => $id,
                          'curriculumId' => $cid,
                        ];
                        $this->disciplineModel->addDisciplineForCurriculum($dcdata);
                      }
                      
                      $fp = fopen('../public/JSONS/file' . $id . '.json', 'w');
                      fwrite($fp, json_encode($json, JSON_UNESCAPED_UNICODE));
                      fclose($fp);

                      flash('discipline_success', "Успешно добавихте дисциплина!");
                      redirect('disciplines/index');
                     } else {
                      die('Something went wrong');
                     }

            } else {
                $data = [
                    'mainInfo' => '',
                  ];
            
                  $this->view('disciplines/import', $data);
            }
          }
        
          public function visualise($id){
            $discipline = $this->disciplineModel->getDisciplineById($id);

            $data = [
                'discipline' => $discipline
            ];

            $this->view('disciplines/visualise', $data);
          }

          public function download($id){

              $file ="../public/JSONS/file" . $id . ".json";
              if(file_exists($file)) { 
              }else{
                  die($file);
              }
            
              $type = filetype(json_decode($file));

              if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Transfer-Encoding: binary');
                header('Content-Type: application/json; charset=utf-8'); 
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));

                /*Without those two PRECIOUS lines the file is an html page for some ILLOGICAL reason */
                ob_clean();
                flush();

                readfile($file);
          }
        }
              
      }
?>          