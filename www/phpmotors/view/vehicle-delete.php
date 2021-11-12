<?php
// if the user is not logged in, the client data wouldn't exist. 
// So we just need to check the level. 
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?>
<?php 
$classificationList = '<select name="classificationId" id="classificationId">';
$classificationList .= "<option>Choose a Car Classification</option>";
foreach ($classifications as $classification) {
 $classificationList .= "<option value='$classification[classificationId]'";
 if(isset($classificationId)){
  if($classification['classificationId'] === $classificationId){
   $classificationList .= ' selected ';
  }
 } elseif(isset($invInfo['classificationId'])){
 if($classification['classificationId'] === $invInfo['classificationId']){
  $classificationList .= ' selected ';
 }
}
$classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title><title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title></title>
</head>
<body>
<div class="logo-bar">
    <img src="/phpmotors/images/site/logo.png" alt="Logo for PHPMotors">
    <?php if (isset($_SESSION['loggedin'])) {
        if ($_SESSION['loggedin']){
            echo "<p>Welcome <a class='header-link' href='/phpmotors/accounts/'>".$_SESSION['clientData']['clientFirstname']."</a>";
            echo " | <a class='header-link' href='/phpmotors/accounts?action=logout'>Logout</a> </p>";
        }
        
        } else{
            echo "<a class='header-link' href='/phpmotors/accounts/?action=login'>My Account</a>";
        }
    ?>
    
</div>
<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <div class="main_content">
        <h1><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
        <?php
                    if (isset($message)) {
                    echo $message;
                    }
                    ?>
        <form action="/phpmotors/vehicles/" method="post">            
            <label for="make">Make:</label><br>
            <input type="text" name="make" id="make" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>
            <label for="model">Model:</label><br>
            <input type="text" name="model" id="model" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>
            <label for="description">Description:</label><br>
            <textarea name="description" id="description" cols="30" rows="10" required><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo  $invInfo['invDescription']; } if(isset($Description)){echo "value='$Description'";}?></textarea><br>
            
            
            
           


            <input type="submit" name="submit" value="Delete Vehicle">
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="
            <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
            elseif(isset($invId)){ echo $invId; } ?>
            ">
        </form>
    </div>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>