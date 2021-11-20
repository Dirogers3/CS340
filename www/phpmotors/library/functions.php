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
  $dv .= "<a href='/phpmotors/vehicles/?action=getVehicleInfo&invId=".urlencode($vehicle['invId'])."' title='View $vehicle[invMake] $vehicle[invModel]'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
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
 $vInfo .= "<img id='vehicle-detail-img' src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
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