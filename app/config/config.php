<?php
    // DB Params
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', "");
    define('DB_NAME', 'curriculumsprojectdb');
    /* 
        App Root - whatever the path of the project folder on the machine is + \app folder. 
        Originally it was dirname(dirname(__FILE__)) - two folders back from the current (config) file, which should normally work.
        However, there was a problem on the live demo, so configure the path manually.
    */
    define('APPROOT', 'C:\xampp\htdocs\FMIcurriculums' . '\app');
    // Url Root
    define('URLROOT', 'http://localhost/FMIcurriculums');
    // Site Name
    define('SITENAME', 'FMI curriculums');

    define('APPVERSION', '1.0.0');
?>
