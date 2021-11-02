<?php

    // Get the database connection file
    require_once '../library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    // Get the accounts model
    require_once '../model/accounts-model.php';
    // Get the functions library
    require_once '../library/functions.php';
    // Get the array of classifications
	$classifications = getClassifications();

    // var_dump($classifications);
    // exit;

    // Build a navigation bar using the $classifications array
    $navList = buildNav($classifications);

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
            
        case 'Login':
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);
            if(empty($clientEmail) || empty($checkPassword)){
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/login.php';
                exit; 
            }
            break;


        case 'registration':
            include '../view/registration.php'; 
            break;        
                
        case 'register':
            // Filter and store the data
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);

            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit; 
            }

            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);



            // Send the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
            if($regOutcome === 1){
                $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                include '../view/login.php';
                exit;
            } else {
                $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }
        default:
            $pageTitle = 'Home';
            header('Location: ../index.php');
            break;
            
        }
        
            
?>