<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title><?php echo $classificationName; ?> Image Management | PHP Motors, Inc.</title>
</head>
<body>
    
    <div class="logo-bar">
        <img src="/phpmotors/images/site/logo.png" alt="Logo for PHPMotors">
        <?php if (isset($_SESSION['loggedin'])) {
        if ($_SESSION['loggedin']){
            echo "<p>Welcome <a class='header-link' href='/phpmotors/accounts/'>".$_SESSION['clientData']['clientFirstname']."</a>";
            echo " | <a class='header-link' href='/phpmotors/accounts?action=logout'>Logout</a> </p>";
        }
        } else {
            echo "<a class='header-link' href='/phpmotors/accounts/?action=login'>My Account</a>";
        }
         ?>
    </div>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <div class="classification">
        <?php if (isset($message)) {echo $message;} if (isset($_SESSION['message'])) {echo $_SESSION['message'];}?>
    </div>
    <h1>Image Management</h1>
    <p>Welcome to the Inventory Image Management page!</p>
    <h2>Add New Vehicle Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
 <label for="invItem">Vehicle</label>
	<?php echo $prodSelect; ?>
	<fieldset>
		<label>Is this the main image for the vehicle?</label>
		<label for="priYes" class="pImage">Yes</label>
		<input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
		<label for="priNo" class="pImage">No</label>
		<input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
	</fieldset>
 <label>Upload Image:</label>
 <input type="file" name="file1">
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
<hr>
<h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>
    
    <?php require '../modules/footer.php'?>
</body>
</html>
<?php unset($_SESSION['message']); ?>