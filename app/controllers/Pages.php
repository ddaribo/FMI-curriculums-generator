<?php
    class Pages extends Controller{
        public function __construct(){
           
        }

        public function index(){
            $data = [
                'title' => 'FMI curriculums',
                'description' => 'В системата FMI curriculums студентите могат
                                    да разглеждат учебните планове на специалностите от различни випуски и изучаваните дисциплини.'
            ];

            $this->view('pages/index', $data);
        }


    }
?>