<?php
//This is the Vehicles Model


//function to handle the car classifications

function addClassification($classification){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO carclassification (classificationName)
    VALUES (:classification)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classification', $classification, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function addVehicle($Make, $Model, $Description, $ImagePath, $Thumbnail, $Price, $Stock, $Color, $classificationId) {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
    VALUES (:Make, :Model, :Description, :ImagePath, :Thumbnail, :Price, :Stock, :Color, :classificationId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next 7 lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':Make', $Make, PDO::PARAM_STR);
    $stmt->bindValue(':Model', $Model, PDO::PARAM_STR);
    $stmt->bindValue(':Description', $Description, PDO::PARAM_STR);
    $stmt->bindValue(':ImagePath', $ImagePath, PDO::PARAM_STR);
    $stmt->bindValue(':Thumbnail', $Thumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':Price', $Price, PDO::PARAM_STR);
    $stmt->bindValue(':Stock', $Stock, PDO::PARAM_STR);
    $stmt->bindValue(':Color', $Color, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}


// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
 $db = phpmotorsConnect(); 
 $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
 $stmt = $db->prepare($sql); 
 $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
 $stmt->execute(); 
 $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
 $stmt->closeCursor(); 
 return $inventory; 
}

// Get vehicle information by invId
function getInvItemInfo($invId){
 $db = phpmotorsConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $invInfo;
}

// Update a vehicle
	function updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId) {
  $db = phpmotorsConnect();
  $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
  $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function deleteVehicle($invId) {
 $db = phpmotorsConnect();
 $sql = 'DELETE FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}

function getVehiclesByClassification($classificationName){
 $db = phpmotorsConnect();
 $sql = 'SELECT * FROM images JOIN inventory ON inventory.invId = images.invId WHERE images.imgPath LIKE "%-tn%"  AND images.imgPrimary = 1 AND inventory.classificationId IN (Select classificationId FROM carclassification WHERE classificationName = :classificationName)';
//  $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
 $stmt->execute();
 $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $vehicles;
}

function getVehicleById($invId){
 $db = phpmotorsConnect();
 $sql = 'SELECT * FROM images JOIN inventory ON inventory.invId = images.invId JOIN carclassification on carclassification.classificationId = inventory.classificationId WHERE inventory.invId =:invId AND images.imgPrimary = 1';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $vehicle;
}

// Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}