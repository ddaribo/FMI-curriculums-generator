<?php
    $file = APPROOT . "/JSONS/file" . $data['discipline']->id . ".json";

    if(!file_exists($file)) { 
        echo "ok ";
    }else{
        die("I'm sorry, the file doesn't seem to exist.")
    };

    $type = filetype(json_encode($file));
    // Get a date and timestamp
    $today = date("F j, Y, g:i a");
    $time = time();
    // Send file headers
    header("Content-type: $type");

    //** If you think header("Content-type: $type"); is giving you some problems,
    //** try header('Content-Type: application/octet-stream');

    //** Note filename= --- if using $_GET to get the $file, it needs to be "sanitized".
    //** I used the basename function to handle that... so it looks more like:
    //** header('Content-Disposition: attachment; filename=' . basename($_GET['mygetvar']));

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename=' . $file);
    header('Expires: 0'); //No caching allowed
    header('Cache-Control: must-revalidate');
    header('Content-Length: ' . strlen($data));
    // Send the file contents.
    set_time_limit(0);
    ob_clean();
    flush();
    readfile($file);

    //** If you are going to try and force download a file by opening a new tab via javascipt
    //** (In this code you would replace the onClick() event handler in the html
    //** button with onclick="window.open('www.someurl.com', '_blank');"
    //** - where 'www.someurl.com' is the url to the php page - I keep the file
    //** creation and download handling in the same file, and $_GET the file name
    // - bad practice? Probably, but I never claimed to be an expert),
    //** be sure to include exit(); in this part of the php... 
    //** otherwise leave exit(); out of the code.
    //** If you don't, it will likely break the code, based on my experience.

    //exit();
?>