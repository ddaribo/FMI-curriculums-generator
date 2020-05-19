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
                $oksArr = [];
                foreach($json['ОКС'] as $oks){
                  $oksArr[] = $oks;
                }
                $years = [];
                foreach($json['Академични години'] as $year){
                  $years[] = $year;
                }
                foreach($specialties as $specialty){
                  foreach($years as $year){
                    foreach($oksArr as $oks){
                      $curriculumdata = [
                        'oks' => $oks,
                        'specialty' => $specialty,
                        'academicYear' => $year,
                      
                    ];
                      $this->curriculumModel->addCurriculum($curriculumdata);
                      $returnedCurriculumIdsObjects[] =  $this->curriculumModel->getCurriculumByNameAndYearAndOKS($curriculumdata);
                    }
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
        
          
          private function getFile($id){
            $json_data = file_get_contents(URLROOT . "/public/JSONS/file" . $id . ".json");
            $json = json_decode($json_data, true);
            return $json;
          }
          
          private function createShortDisplay($id){
            $discipline = $this->disciplineModel->getDisciplineById($id);
            $json = $this->getFile($id);
            
            $display = "
            <div class=\"title\">" .
            "<h1>" . $discipline->disciplineNameBg . "</h1>" . 
            "<h3>" . $discipline->disciplineNameEng . "</h3>" . 
            "</div>" . 
            "<div id=\"credits\">" .
            "<h3>" . $discipline->credits . " кредита</h3>" .
            "</div>" .
            "<div class=\"mainInfoContainer\">" .
            "<div id=\"specialties\">" .
            "<h4>Изучава се от специалности:</h4>" .
            "<ul>";

            foreach($json["Специалности"] as $specialty){ 
                $display = $display . 
                "<li>" . $specialty . "</br></li>";
              }
              $display = $display . "</ul>" .
              "</div>" . 
              "<div id=\"elective\">" .
              "<h4>Статут:</h4>" .
              "<h3>" . $discipline->elective . "</h3>" .
              "</div>" .
              "</div>" .
              "<div id=\"lecturer\">" .
              "<h4>Преподавател</h4>" .
                "<p>" . $discipline->professor ."</p>" .
              "</div>" .
              "<div class=\"grayContainer\">" .
              "<div id=\"annotation\">" .
              "<h4>Анотация</h4>" .
                  "<p>" . $discipline->annotation . "</p>" .
                  "</div>" .
                  "</div>"
                  ;
                  
                  return $display;
          }
          
          private function createDetailedDisplay($id){
            $discipline = $this->disciplineModel->getDisciplineById($id);
            $json = $this->getFile($id);
            
            $display = $this->createShortDisplay($id) .
            "<div id=\"prerequisites\">" .
            "<h4>Предварителни изисквания</h4>" .
            "<p>" . $discipline->prerequisites . "</p>" .
            "</div>" .
            "<div id=\"expectations\">" .
            "<h4>Очаквани резултати</h4>" .
            "<p>" . $discipline->expectations . "</p>" .
            "<p>" . /*echo str_replace('.', ". " . "</br>", $json["Очаквани резултати"]); */"</p>" .
            "</div>" . 
            "<div id=\"content\">" .
            "<div class=\"tableTitle\">" .
            "<h4>Съдържание</h4>" .
            "</div>" .
            "<table>" .
                "<tr>" .
                "<th>№</th>" .
                "<th>Тема</th>" .
                  "</tr>";
                  $count = 0;
                  foreach($json["Съдържание"] as $topic){ 
                          $display = $display . 
                          "<tr>" .
                          "<td>" . ++$count . "</td>" .
                          "<td>" . $topic . "</br></td>" .
                            "</tr>";
                          } 
                          $count = 0;
            $display = $display . "</table>" .
            "</div>" . 
            "<div id=\"synopsis\">" .
            "<div class=\"tableTitle\">" .
                "<h4>Конспект</h4>" .
                "</div>" .
                "<table>" .
                "<tr>" .
                "<th>№</th>" .
                "<th>Тема</th>" .
                "</tr>";
                $count = 0;
                foreach($json["Конспект"] as $topic){ 
                  $display = $display . 
                  "<tr>" .
                  "<td>" . ++$count . "</td>" .
                  "<td>" . $topic . "</br></td>" .
                  "</tr>";
                      } 
                      $count = 0;
                      $display = $display . "</table>" .
            "</div>" . 
            "<div id=\"bibliography\">" .
            "<div class=\"tableTitle\">" .
                "<h4>Библиография</h4>" .
                "</div>" .
              "<table>" .
                "<tr>" .
                "<th>№</th>" .
                  "<th>Източник</th>" .
                  "</tr>";
                  $count = 0;
                      foreach($json["Библиография"] as $topic){ 
                        $display = $display . 
                        "<tr>" .
                              "<td>" . ++$count . "</td>" .
                              "<td>" . $topic . "</br></td>" .
                              "</tr>";
                            } 
                            $count = 0;
            $display = $display . "</table>" .
            "</div>";
            
            return $display;
          }
          
          private function creatAdminDisplay($id){
            $discipline = $this->disciplineModel->getDisciplineById($id);
            $json = $this->getFile($id);
            
            $display = $this->createDetailedDisplay($id) . 
            "<div id=\"administrative\">" .
            "<h2>Административна информация</h2>";
            foreach($json["Административна информация"] as $adminInfoTitle => $value){
              $display = $display . "<strong>" . $adminInfoTitle . ": </strong> " . $value . "</br>";
            }
            $display = $display . "</div>";
            
            return $display;
          }
          
          public function short($id){
            ob_clean();
            flush();
            
            $display = $this->createShortDisplay($id);

            echo $display;
          }
          
          public function detailed($id){
            ob_clean();
            flush();
            
            $display = $this->createDetailedDisplay($id);
            
            if(isLoggedIn()){
              echo $display;
            } else{
              echo "Нямате достъп до този режим на преглед! Влезте в системата или се регистрирайте, за да видите повече за тази дисциплина.";
            }
          }
          
          public function admin($id){
            ob_clean();
            flush();
            
            $display = $this->creatAdminDisplay($id);
            
            if($_SESSION['user_role'] == 'admin'){
              echo $display;
            } else{
              echo "Нямате достъп до този режим на преглед!";
            }
          }
          
          public function visualise($id){
            $discipline = $this->disciplineModel->getDisciplineById($id);
            $defaultDisplay = $this->createShortDisplay($id);

            $data = [
                'discipline' => $discipline,
                'defaultDisplay' => $defaultDisplay
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


        public function edit($id){
          if($_SESSION['user_role'] != 'admin'){
            redirect('disciplines');
          }

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
                  'id' => $id,
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
              $oksArr = [];
              foreach($json['ОКС'] as $oks){
                $oksArr[] = $oks;
              }
              $years = [];
              foreach($json['Академични години'] as $year){
                $years[] = $year;
              }
              foreach($specialties as $specialty){
                foreach($years as $year){
                  foreach($oksArr as $oks){
                    $curriculumdata = [
                      'oks' => $oks,
                      'specialty' => $specialty,
                      'academicYear' => $year,
                    
                  ];
                    $this->curriculumModel->addCurriculum($curriculumdata);
                    $returnedCurriculumIdsObjects[] =  $this->curriculumModel->getCurriculumByNameAndYearAndOKS($curriculumdata);
                  }
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
               
              if($this->disciplineModel->updateDiscipline($data)){
                
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
                flash('discipline_updated', "Успешно редактирахте дисциплината!");
                redirect('disciplines/index');
               } else {
                die('Something went wrong');
               }

          } else {
              $fp = fopen('../public/JSONS/file' . $id . '.json', 'r'); 
              $data = [
                  'id' => $id,
                ];
          
                $this->view('disciplines/edit', $data);
          }
        }

        public function delete($id){
          if($_SESSION['user_role'] == 'admin'){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
              if($this->disciplineModel->deleteDiscipline($id)){
                flash('discipline_message', 'Discipline removed');
                redirect('disciplines');
              } else {
                die('Something went wrong');
              }
            } else{
              redirect('disciplines');
            }
          }
        } 

      }
?>          