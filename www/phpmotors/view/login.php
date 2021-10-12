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
        <nav>
            <?php echo $navList; ?>
        </nav>
        <h1>Login</h1>
        <div class="loginform">
            <form action="/">
                        <div>
                            <label for="Username">Username</label>
                            <input name="Username" type="text" id="Username" placeholder="username" required>
                        </div>
                        <div>
                            <label for="userPassword">Password</label>
                            <input name="userPasswrod" type="text" id="userPassword" placeholder="password" required>
                        </div>
                        <button>Login</button>
                        <p>No Account? <a href="/phpmotors/index.php?action=registration">Sign-up</a></p>
            </form>
        </div>
    <?php require './modules/footer.php'?>
</body>
</html>