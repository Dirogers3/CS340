<?php

    // Get the database connection file
    require_once '../library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    // Get the array of classifications
	$classifications = getClassifications();

    // var_dump($classifications);
    // exit;

    // Build a navigation bar using the $classifications array
    $navList = '<ul class="navbar">';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';

    //nav list check
    // echo $navList;
    // exit;

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    }
    switch ($action) {
        
        case 'login':
            $pageTitle = 'Account Login';
            include '../view/login.php';
            break;
            
        case 'registration':
            $pageTitle = 'Account Registration';
            include '../view/registration.php';
            break;
        
        default:
            $pageTitle = 'Home';
            header('Location: ../index.php');
            break;
            
        }
        
            
?>