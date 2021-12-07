<?php

function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}
   // Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function buildNav($classifications) {
    // Build a navigation bar using the $classifications array
    $navList = '<ul class="navbar">';
    $navList .= "<li><a href='/phpmotors/index.php'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;

}

// Build the classifications select list 
function buildClassificationList($classifications){ 
 $classificationList = '<select name="classificationId" id="classificationList">'; 
 $classificationList .= "<option>Choose a Classification</option>"; 
 foreach ($classifications as $classification) { 
  $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
 } 
 $classificationList .= '</select>'; 
 return $classificationList; 
}

function buildVehiclesDisplay($vehicles){
 $dv = '<ul id="inv-display">';
 foreach ($vehicles as $vehicle) {
  $dv .= '<li>';
  $dv .= '<div class="vehicle-image-container">';
  $dv .= "<a href='/phpmotors/vehicles/?action=getVehicleInfo&invId=".urlencode($vehicle['invId'])."' title='View $vehicle[invMake] $vehicle[invModel]'><img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
  $dv .= '</div>';
  $dv .= "<h2 id='vehicle-title-line'><a id='vehicle-info-link' href='/phpmotors/vehicles/?action=getVehicleInfo&invId=".urlencode($vehicle['invId'])."'> $vehicle[invModel]</a></h2>";
  $dv .= "<h2 id='vehicle-price-tag'>$" . number_format($vehicle['invPrice'], 2, '.', ',') . "</h2>";
  $dv .= '</li>';
 }
 $dv .= '</ul>';
 return $dv;
}

function buildVehicleInfo($vehicle){
 $vInfo = '<div id="vehicle-info">';
 $vInfo .= "<h1 id='vehicle-details-title'>$vehicle[invMake] $vehicle[invModel]</h1>";
 $vInfo .= "<div class='vehicle-details'>";
 $vInfo .= "<div class='vehicle-details-left'>";
 $vInfo .= "<img id='vehicle-detail-img' src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
 $vInfo .= "<h3 id='vehicle-detail-price'>$" . number_format($vehicle['invPrice'], 2, '.', ',') . "</h3>";
 $vInfo .= '</div>';
 $vInfo .= "<div class='vehicle-details-right'>";
 $vInfo .= "<h3>$vehicle[invMake] $vehicle[invModel] Details</h3>";
 $vInfo .= "<h4 id='vehicle-detail-description'>$vehicle[invDescription]</h4>";
 $vInfo .= "<h4 id='vehicle-detail-color'>Color: $vehicle[invColor]</h4>";
 $vInfo .= "<h4 id='vehicle-detail-stock'># in Stock: $vehicle[invStock]</h4>";
 $vInfo .= "</div>";
 $vInfo .= '</div>';
 $vInfo .= '</div>';
 return $vInfo;
}

/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
 $i = strrpos($image, '.');
 $image_name = substr($image, 0, $i);
 $ext = substr($image, $i);
 $image = $image_name . '-tn' . $ext;
 return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
 $id = '<ul id="image-display">';
 foreach ($imageArray as $image) {
  $id .= '<li>';
  $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
  $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image' id='delete-button'>Delete $image[imgName]</a></p>";
  $id .= '</li>';
}
 $id .= '</ul>';
 return $id;
}


// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
 $prodList = '<select name="invId" id="invId">';
 $prodList .= "<option>Choose a Vehicle</option>";
 foreach ($vehicles as $vehicle) {
  $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
 }
 $prodList .= '</select>';
 return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
 // Gets the paths, full and local directory
 global $image_dir, $image_dir_path;
 if (isset($_FILES[$name])) {
  // Gets the actual file name
  $filename = $_FILES[$name]['name'];
  if (empty($filename)) {
   return;
  }
 // Get the file from the temp folder on the server
 $source = $_FILES[$name]['tmp_name'];
 // Sets the new path - images folder in this directory
 $target = $image_dir_path . '/' . $filename;
 // Moves the file to the target folder
 move_uploaded_file($source, $target);
 // Send file for further processing
 processImage($image_dir_path, $filename);
 // Sets the path for the image for Database storage
 $filepath = $image_dir . '/' . $filename;
 // Returns the path where the file is stored
 return $filepath;
 }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
 // Set up the variables
 $dir = $dir . '/';

 // Set up the image path
 $image_path = $dir . $filename;

 // Set up the thumbnail image path
 $image_path_tn = $dir.makeThumbnailName($filename);

 // Create a thumbnail image that's a maximum of 200 pixels square
 resizeImage($image_path, $image_path_tn, 200, 200);

 // Resize original to a maximum of 500 pixels square
 resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
 // Get image type
 $image_info = getimagesize($old_image_path);
 $image_type = $image_info[2];

 // Set up the function names
 switch ($image_type) {
 case IMAGETYPE_JPEG:
  $image_from_file = 'imagecreatefromjpeg';
  $image_to_file = 'imagejpeg';
 break;
 case IMAGETYPE_GIF:
  $image_from_file = 'imagecreatefromgif';
  $image_to_file = 'imagegif';
 break;
 case IMAGETYPE_PNG:
  $image_from_file = 'imagecreatefrompng';
  $image_to_file = 'imagepng';
 break;
 default:
  return;
} // ends the swith

 // Get the old image and its height and width
 $old_image = $image_from_file($old_image_path);
 $old_width = imagesx($old_image);
 $old_height = imagesy($old_image);

 // Calculate height and width ratios
 $width_ratio = $old_width / $max_width;
 $height_ratio = $old_height / $max_height;

 // If image is larger than specified ratio, create the new image
 if ($width_ratio > 1 || $height_ratio > 1) {

  // Calculate height and width for the new image
  $ratio = max($width_ratio, $height_ratio);
  $new_height = round($old_height / $ratio);
  $new_width = round($old_width / $ratio);

  // Create the new image
  $new_image = imagecreatetruecolor($new_width, $new_height);

  // Set transparency according to image type
  if ($image_type == IMAGETYPE_GIF) {
   $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
   imagecolortransparent($new_image, $alpha);
  }

  if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
   imagealphablending($new_image, false);
   imagesavealpha($new_image, true);
  }

  // Copy old image to new image - this resizes the image
  $new_x = 0;
  $new_y = 0;
  $old_x = 0;
  $old_y = 0;
  imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

  // Write the new image to a new file
  $image_to_file($new_image, $new_image_path);
  // Free any memory associated with the new image
  imagedestroy($new_image);
  } else {
  // Write the old image to a new file
  $image_to_file($old_image, $new_image_path);
  }
  // Free any memory associated with the old image
  imagedestroy($old_image);
} // ends resizeImage function

function buildThumbnailDisplay($imageArray) {
 $id = '<ul id="thumbnail-display">';
 foreach ($imageArray as $image) {
  $id .= '<li>';
  $id .= "<img src='$image[imgPath]' alt='This is a thumbnail of a vehicle'>";
  $id .= '</li>';
 }
 $id .= '</ul>';
 return $id;
}


function buildReviewForm($screenName, $clientId, $invId, $vehicleInformation, $successReviewMessage) {
  $id = "<h2>Review the $vehicleInformation[invMake] $vehicleInformation[invModel]</h2>";
  $id.= "<h3 id='successMessage'>$successReviewMessage</h3>";
  $id.= '<div class="reviewform">';
  $id.= '<form action="/phpmotors/reviews/index.php" method="post">';
  $id.= '<label for="screenName">Screen Name:</label>';
  $id.= "<input type='text' name='screenName' id='screenName' id='screenNamewidth' value='$screenName' required readonly>";
  $id.= '<label for="review">Review:</label>';
  $id.= '<textarea name="reviewText" id="review" cols="30" rows="10"></textarea>';
  $id.= '<input id="reviewSubmitBtn" type="submit" name="submit" value="Submit Review">';
  $id.= '<input type="hidden" name="action" value="addReview">';
  $id.= "<input type='hidden' name='invId' value='$invId'>";
  $id.= "<input type='hidden' name='clientId' value='$clientId'>";
  $id.= '</form>';
  $id.= '</div>';
  return $id;
}

// function buildReviewEditForm($clientId, $invId, $invReview) {
//   $id.= '<div class="reviewform">';
//   $id.= '<form action="/phpmotors/reviews/index.php" method="post">';
//   $id.= '<label id="largeText" for="review">Review Text:</label>';
//   $id.= "<textarea name='updatedReviewText' id='review' cols='10' rows='10'>$invReview</textarea>";
//   $id.= '<input id="reviewSubmitBtn" type="submit" name="submit" value="Edit Review">';
//   $id.= '<input type="hidden" name="action" value="updateReview">';
//   $id.= "<input type='hidden' name='invId' value='$invId'>";
//   $id.= "<input type='hidden' name='clientId' value='$clientId'>";
//   $id.= '</form>';
//   $id.= '</div>';
//   return $id;
// }

function buildReviewList($reviewArray) {
  $id = '<ul id="reviewList" class="reviewList">';
  foreach ($reviewArray as $review) {
    $id .= '<li>';
    $id .= substr($review['clientFirstname'], 0, 1) . $review['clientLastname'];
    $id .= "<span id='largeText'>$screenName</span><span id='smallText'> wrote on ".date_format(new DateTime($review['reviewDate']), 'd F, Y')."</span>";
    $id .= "<p id='review'>$review[reviewText]</p>";
    $id .= '</li>';
  }
  $id .= '</ul>';
  return $id;
}
  
function buildAdminReviewList($reviewArray) {
  $id = '<ul id="adminReviewList" class="adminReviewList">';
  foreach ($reviewArray as $review) {
    $id .= '<li>';
    $id .= "<span class='adminReviews' >$review[invMake] $review[invModel] (Reviewed on ".date_format(new DateTime($review['reviewDate']), 'd F, Y')."): <a class='blue' href='/phpmotors/reviews/?action=editReview&reviewId=$review[reviewId]'>Edit</a> | <a class='blue' href='/phpmotors/reviews/?action=getDeleteReview&reviewId=$review[reviewId]'>Delete</a></span>";
    $id .= '</li>';
  }
  $id .= '</ul>';
  return $id;
}

