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

        if(empty($Make) || empty($Model) || empty($Description) || empty($ImagePath) || empty($Thumbnail) || empty($Price) || empty($Stock) || empty($Color) || empty($classificationId)){
            $message = "<p> $classificationId  $Make $Model $Description $ImagePath $Thumbnail $Price $Stock $Color Please provide information for all empty form fields.</p>";
            include '../view/add-vehicle.php';
            exit; 
          }

        addVehicle($Make, $Model, $Description, $ImagePath, $Thumbnail, $Price, $Stock, $Color, $classificationId);
        Header('Location: /phpmotors/vehicles/');

    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
          // Get the classificationId 
          $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
          // Fetch the vehicles by classificationId from the DB 
          $inventoryArray = getInventoryByClassification($classificationId); 
          // Convert the array to a JSON object and send it back 
          echo json_encode($inventoryArray); 
          break;

    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
        $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;

    case 'updateVehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = trim(filter_input(INPUT_POST, 'make', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING)); 
        $invDescription = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'imagepath', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'thumbnailpath', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
        $message = "<p>Please complete all information for the new item! Double check the classification of the item.</p>";
        include '../view/vehicle-update.php';
        exit;
        }
        $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);
        if ($updateResult) {
            $message = "<p class='notify'>Congratulations, the $Make $Model was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Error. The new vehicle was not Edited.</p>";
            include '../view/updated-item.php';
            exit;
        }
        break;

    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
                $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;

    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not
        deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;

    default:
        $classificationList = buildClassificationList($classifications);

        include '../view/vehicle-man.php';
        break;


}