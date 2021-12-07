<?php
//this is the model for reviews

/////////////////////////////////////////////////////////////
//CREATE A REVIEW
/////////////////////////////////////////////////////////////
function addReview($reviewText, $invId, $clientId) {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next 3 lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    
    
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

/////////////////////////////////////////////////////////////
// READ REVIEWS FOR ONE VEHICLE
/////////////////////////////////////////////////////////////
function getReviewsByInvId($invId) {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM reviews JOIN clients ON reviews.clientId = clients.clientId WHERE invId = :invId ORDER BY reviewDate DESC';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $results;
}

/////////////////////////////////////////////////////////////
// READ REVIEWS FROM ONE CLIENT
/////////////////////////////////////////////////////////////
function getReviewsByClientId($clientId) {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM reviews JOIN inventory ON reviews.invId = inventory.invId WHERE clientId = :clientId ORDER BY reviewDate DESC;
';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $results;
}

/////////////////////////////////////////////////////////////
// READ ONE SPECIFIC REVIEW
/////////////////////////////////////////////////////////////
function getOneReview($reviewId) {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM reviews JOIN clients ON reviews.clientId = clients.clientId JOIN inventory ON reviews.invId = inventory.invId WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $results;
}

/////////////////////////////////////////////////////////////
//  UPDATE ONE REVIEW
/////////////////////////////////////////////////////////////
function updateReview($updatedReviewText, $reviewId) {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $updatedReviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}


/////////////////////////////////////////////////////////////
//  DELETE A REVIEW
/////////////////////////////////////////////////////////////
function deleteReview($reviewId) {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}
