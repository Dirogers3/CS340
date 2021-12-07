<?php
// this is the review controller

session_start(); 

require_once '../library/connections.php'; // database connection file
require_once '../model/main-model.php'; // model file for main
require_once '../model/vehicles-model.php'; // model file for vehicles
require_once '../library/functions.php'; // functions file
require_once '../model/uploads-model.php'; // model file for uploads
require_once '../model/reviews-model.php'; // model file for reviews

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// exit;


// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

switch ($action) {

/////////////////////////////////////////////////////////////
//  ADD A REVIEW
/////////////////////////////////////////////////////////////
    case 'addReview':
        // filter and store the data
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        $reviewList = getReviewsByInvId($invId);
        if (isset($reviewList)) {
                $reviews = buildReviewList($reviewList);
            } else {
                $reviews = '<p>Be the first to write a review!</p>';
            }

        // check for missing data
        if (empty($reviewText) || empty($invId) || empty($clientId)) {
            $message = '<p class="notice">Please provide information for all empty form fields.</p>';
            include '../view/reviews.php';
            exit;
        }

        $reviewSuccessful = addReview($reviewText, $invId, $clientId);

        if ($reviewSuccessful) {
            $successReviewMessage = "<p class='notice'>Thanks for the review, it is displayed below</p>";
            $_SESSION['successReviewMessage'] = $successReviewMessage;

            $vehicleInformation = getVehicleById($invId);
            $thumbnailById = getThumbnailById($invId);
            $vehicleThumbnailDisplay = buildThumbnailDisplay($thumbnailById);
            $vehicleInfo = buildVehicleInfo($vehicleInformation);

            if (isset($_SESSION['loggedin'])) {
                $screenName = substr($_SESSION['clientData']['clientFirstname'], 0, 1).$_SESSION['clientData']['clientLastname'];
                $clientId = $_SESSION['clientData']['clientId'];
                
                $reviewForm = buildReviewForm($screenName, $clientId, $invId, $vehicleInformation, $successReviewMessage);
                
            }
            
        } else {
            $message = "<p class='notice'>Review failed to be added.</p>";
        }

        header("Location: /phpmotors/vehicles/?action=getVehicleInfo&invId=$invId");
        break;


/////////////////////////////////////////////////////////////
//  UPDATE A REVIEW PAGE
/////////////////////////////////////////////////////////////
    case 'editReview':
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = $_SESSION['clientData']['clientId'];
        $oneReview = getOneReview($reviewId);
        $invMake = $oneReview[0]['invMake'];
        $invModel = $oneReview[0]['invModel'];
        $invReview = $oneReview[0]['reviewText'];
        $reviewDate = $oneReview[0]['reviewDate'];

        include '../view/review-edit.php';
        break;

/////////////////////////////////////////////////////////////
//  UPDATE A REVIEW
/////////////////////////////////////////////////////////////
    case 'updateReview':
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $reviewText = trim(filter_input(INPUT_GET, 'updatedReviewText', FILTER_SANITIZE_STRING));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));


        $updatedReviewText = trim(filter_input(INPUT_POST, 'updatedReviewText', FILTER_SANITIZE_STRING));

        if(empty($updatedReviewText)) {
            $_SESSION['updateMessage'] = '<p class="notice">Please provide information for all empty form fields.</p>';
            include '../view/review-edit.php';
            exit;
        }
        $updateSuccessful = updateReview($updatedReviewText, $reviewId);
        
        if ($updateSuccessful) {
            $_SESSION['updateMessage'] = "<p class='notice'>Review successfully updated.</p>";
            header("Location: /phpmotors/accounts");
            exit();
        } else {
            $updateMessage = "<p class='notice'>Review failed to be updated.</p>";
            header("Location: /phpmotors/accounts");
            $_SESSION['updateMessage'] = false;
            exit;
        }
        break;


/////////////////////////////////////////////////////////////
//  DELETE A REVIEW PAGE
/////////////////////////////////////////////////////////////
    case 'getDeleteReview':
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $oneReview = getOneReview($reviewId);
        $invReview = $oneReview[0]['reviewText'];
        $reviewDate = $oneReview[0]['reviewDate'];
        $invMake = $oneReview[0]['invMake'];
        $invModel = $oneReview[0]['invModel'];

        include '../view/review-delete.php';
        break;


/////////////////////////////////////////////////////////////
//  DELETE A REVIEW
/////////////////////////////////////////////////////////////
    case 'deleteReview':
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $deleteSuccessful = deleteReview($reviewId);

        if ($deleteSuccessful) {
            $_SESSION['deleteMessage'] = "<p class='notice'>The review deleted succesfully.</p>";
            header("Location: /phpmotors/accounts");
            exit();
        } else {
            $deleteMessage = "<p class='notice'>Review failed to be deleted.</p>";
            header("Location: /phpmotors/accounts");
            $_SESSION['deleteMessage'] = false;
            exit;
        }
        
        break;


    
    default:
        $_SESSION['updateMessage'] = false;
        include '../view/admin.php';

    };
?>