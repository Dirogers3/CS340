<?php
require_once '../library/connections.php'; // database connection file
require_once '../model/main-model.php'; // model file for main
require_once '../model/vehicles-model.php'; // model file for vehicles

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


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'add-classification':
        include '../view/add-classification.php';
        break;

    case 'add-vehicle':
        include '../view/add-vehicle.php';
        break;

    case 'addClassification':
        $classification = filter_input(INPUT_POST, 'classification');
        addClassification($classification);
        header("Location: /phpmotors/vehicles/");
    
    

    case "addVehicleToDatabase":
        $Make = filter_input(INPUT_POST, 'make');
        $Model = filter_input(INPUT_POST, 'model');
        $Description = filter_input(INPUT_POST, 'description');
        $ImagePath = filter_input(INPUT_POST, 'imagepath');
        $Thumbnail = filter_input(INPUT_POST, 'thumbnailpath');
        $Price = filter_input(INPUT_POST, 'price');
        $Stock = filter_input(INPUT_POST, 'stock');
        $Color = filter_input(INPUT_POST, 'color');
        $classificationId = filter_input(INPUT_POST, 'classificationId');
        addVehicle($Make, $Model, $Description, $ImagePath, $Thumbnail, $Price, $Stock, $Color, $classificationId);
        Header('Location: /phpmotors/vehicles/');

    default:
        include '../view/vehicle-man.php';
        break;
}