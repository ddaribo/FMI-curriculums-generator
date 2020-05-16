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
    }
?>