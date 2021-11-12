<?php

//Create or access a Session
session_start();

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

    // Check if firstname cookie is exists and get its value
    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    } 

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
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);
            if(empty($clientEmail) || empty($checkPassword)){
                echo $clientEmail;
                echo $checkPassword;
                echo '<p class="error">This failed.</p>';
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/login.php';
                exit; 
            }
            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            // If the hashes don't match create an error
            // and return to the login view
            if(!$hashCheck) {
                echo '<p class="notice">Hash password misfire</p>';
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
            }
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view
            include '../view/admin.php';
            exit;
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

            // checking for existing email address
            $existingEmail = checkExistingEmail($clientEmail);

            // Check for existing email in the table
            if($existingEmail){
                $message = "<p class='notice'>That email address already exists. Do you want to log in instead?</p>";
                include '../view/login.php';
                exit;
            }

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
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
                header('Location: /phpmotors/accounts/?action=login');
                exit;
            } else {
                $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }

            case 'logout':
                session_destroy();
                header('Location: /phpmotors/accounts/?action=login');
                exit;
                break;

            case 'update':
                $clientInfo = getClient($_SESSION['clientData']['clientEmail']);
                $clientId = $_SESSION['clientData']['clientId'];
                include '../view/client-update.php';
                break;
            case 'updateAccount':
                $clientId = filter_input(INPUT_POST, 'clientId',FILTER_SANITIZE_NUMBER_INT);
                $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
                $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
                $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
                $clientEmail = checkEmail($clientEmail);
                $emailCheck = checkExistingEmail($clientEmail);
                if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
                    $message = '<p>Please provide information for all empty form fields</p>';
                    include '../view/client-update.php';
                    exit;
                }
                if ($emailCheck) {
                    $message = '<p>Email already exists. Please choose a different email.</p>';
                    include '../view/client-update.php';
                    break;
                }
                $updateResult = updateClient($clientFirstname,$clientLastname,$clientEmail,$clientId);
                if ($updateResult) {
                    $message = "$clientFirstname, your account has been successfully updated.";
                    $_SESSION['message'] = $message;

                    $clientData = getClientById($clientId);
                    // remove password
                    array_pop($clientData);

                    $_SESSION['clientData'] = $clientData;
                    header('Location: /phpmotors/accounts/');
                    exit;
                } else {
                    $message = "<p>Sorry $clientFirstname, $updateResult account failed to update.</p>";
                    include '../view/client-update.php';
                    exit;
                }
                break;

            case 'updatePassword':
                $clientId = filter_input(INPUT_POST, 'clientId',FILTER_SANITIZE_NUMBER_INT);
                $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
                $checkPassword = checkPassword($clientPassword);
                if (empty($checkPassword)) {
                $message = '<p>Invalid Password.</p>';
                    include '../view/client-update.php';
                    exit;
                }
                $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
                $updatePassOutcome = updatePassword($hashedPassword,$clientId);
                if ($updatePassOutcome === 1) {
                    $_SESSION['message'] = "Password succesfully changed!";
                    $clientData = getClientById($clientId);
                    // remove password
                    array_pop($clientData);
                    $_SESSION['clientData'] = $clientData;
                    header('Location: /phpmotors/accounts/');
                    exit;
                } else {
                    $message = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
                    include '../view/client-update.php';
                    exit;
                }
                // Maintain stickiness
                $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
                $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
                $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
                break;

        default:
            $pageTitle = 'Home';
            $clientId = $_SESSION['clientData']['clientId'];

            include '../view/admin.php';
            break;
            
        }
        
            
?>