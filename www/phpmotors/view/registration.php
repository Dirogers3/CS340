<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title>Template</title>
</head>
<body class="body">
    <?php require './modules/header.php'?>
    <?php echo $navList; ?>
    <h2>Registration</h2>
    
    <div class="loginform">
        <form>
            <label for="userFirstname">First Name</label><br>
            <input name="userFirstname" id="userFirstname" type="text"><br>
            <label for="userLastname">Last Name</label><br>
            <input name="userLastname" id="userLastname" type="text"><br>
            <label for="userEmail">Email</label><br>
            <input name="userEmail" id="userEmail" type="email"><br><br>
            <label for="userPassword">Password (Passwords must be at least 8 characters and contain at least 1 number, 1 captital letter and 1 special character)</label><br>
            <input name="userPassword" id="userPassword" type="password"><br>
            <input type="submit" value="Register">
        </form>
    </div>
    <?php require './modules/footer.php'?>
</body>
</html>