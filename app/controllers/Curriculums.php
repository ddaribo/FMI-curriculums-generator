<?php
    class Curriculums extends Controller{
        
        public function __construct(){
            
            $this->curriculumModel = $this->model('Curriculum');
        }

        
        public function index(){
            $disciplines = $this->curriculumModel->getCurriculums();

            $data = [
                'curriculums' => $curriculums
            ];

            $this->view('curriculums/index', $data);
        }

    }
?>