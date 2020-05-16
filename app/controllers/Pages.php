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

        public function about(){
            $data = [
                'title' => 'About',
                'description' => 'Тук трябва да се преглеждат съществуващите учебни планове.'
            ];
            $this->view('pages/about', $data);
        }

    }
?>