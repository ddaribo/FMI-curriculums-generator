<?php
    // DB Params — values can be overridden via environment variables (e.g. in Docker)
    define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
    define('DB_USER', getenv('DB_USER') ?: 'root');
    define('DB_PASS', getenv('DB_PASS') ?: '');
    define('DB_NAME', getenv('DB_NAME') ?: 'curriculumsprojectdb');
    // App Root
    define('APPROOT', dirname(dirname(__FILE__)));
    // Url Root
    define('URLROOT', 'http://localhost/FMIcurriculums');
    // Site Name
    define('SITENAME', 'FMI curriculums');

    define('APPVERSION', '1.0.0');
?>
