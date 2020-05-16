<?php
    class Disciplines extends Controller{
        public function __construct(){
            /*Remove this is we want guest users to access the disciplines content */
            /*if(!isLoggedIn()){
                redirect('users/login');
            }*/
            
            $this->disciplineModel = $this->model('Discipline');
        }

        
        public function index(){
            $disciplines = $this->disciplineModel->getDisciplines();

            $data = [
                'disciplines' => $disciplines
            ];

            $this->view('disciplines/index', $data);
        }
    }
?>