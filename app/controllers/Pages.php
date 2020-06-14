<?php
    class Pages extends Controller{
        public function __construct(){
           
        }

        public function index(){
            $data = [
                'title' => 'FMI curriculums',
                'description' => 'В системата за учебни планове на ФМИ студентите могат
                                    да разглеждат учебните планове на специалностите от различни випуски.'
            ];

            $this->view('pages/index', $data);
        }


    }
?>