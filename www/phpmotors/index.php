<?php

    // Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
require_once 'library/functions.php';
    // Get the array of classifications
	$classifications = getClassifications();

    // var_dump($classifications);
    // exit;

    $navList = buildNav($classifications);
    //nav list check
    // echo $navList;
    // exit;

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    }
    switch ($action) {
        
        case 'template':
            include 'view/template.php';
            break;
            
        default:
            $pageTitle = 'Home';
            include 'view/home.php';
            break;
        }
        
            
?>