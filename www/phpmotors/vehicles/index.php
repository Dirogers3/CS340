<?php
//Create or access a Session
session_start();


require_once '../library/connections.php'; // database connection file
require_once '../model/main-model.php'; // model file for main
require_once '../model/vehicles-model.php'; // model file for vehicles
require_once '../library/functions.php'; // functions file

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// exit;


// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);

// Check if firstname cookie is exists and get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
} 


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {

////////////////////////////////////////////////////////////////////////////////
// displaying and adding the Classifications 
////////////////////////////////////////////////////////////////////////////////
    case 'add-classification':
        include '../view/add-classification.php';
        break;

    case 'addClassification':
        $classification = filter_input(INPUT_POST, 'classification');

        if(empty($classification)) {
            $message = '<p>Please provide information for this empty form field or limit to less than 30 characters.</p>';
            include '../view/add-classification.php';
            exit; 
        }

        addClassification($classification);
        header("Location: /phpmotors/vehicles/");

        break;


////////////////////////////////////////////////////////////////////////////////
// displaying and adding the vehicle 
////////////////////////////////////////////////////////////////////////////////

    case 'add-vehicle':
        include '../view/add-vehicle.php';
        break;

    
    

    case "addVehicleToDatabase":
        $Make = trim(filter_input(INPUT_POST, 'make', FILTER_SANITIZE_STRING));
        $Model = trim(filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING)); 
        $Description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
        $ImagePath = trim(filter_input(INPUT_POST, 'imagepath', FILTER_SANITIZE_STRING));
        $Thumbnail = trim(filter_input(INPUT_POST, 'thumbnailpath', FILTER_SANITIZE_STRING));
        $Price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $Stock = trim(filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT));
        $Color = trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING));

        if(empty($Make) || empty($Model) || empty($Description) || empty($Image) || empty($Thumbnail) || empty($Price) || empty($Stock) || empty($Color) || empty($classificationId)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit; 
          }

        addVehicle($Make, $Model, $Description, $ImagePath, $Thumbnail, $Price, $Stock, $Color, $classificationId);
        Header('Location: /phpmotors/vehicles/');

    default:
        include '../view/vehicle-man.php';
        break;
}