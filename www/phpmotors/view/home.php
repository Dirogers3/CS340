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
    <title>PHP Motors - DMC Delorean</title>
</head>
<body>
<?php require './modules/header.php'?>
<nav>
    <?php echo $navList; ?> 
</nav>
    <h1 id="welcomeheading">Welcome to PHP Motors!</h1>
        <div class="main">
            <div class="img-desc">
                <h2 id="bluecolor">DMC Delorean</h2>
                <ul>
                    <li>3 Cup holders</li>
                    <li>Superman doors</li>
                    <li>Fuzzy dice!</li>
                </ul>
                    <button class="ownbutton">Own Today</button>
            </div>
            <img src="./images/delorean.jpg" class="carimg" alt="animated image of delorean">
            <div class="attributes">
                <div class="upgrades">
                <h3>Delorean Upgrades</h3>
                    <div class="upgrades-row1">
                        <div class="upgrade-card">
                            <div class="card-img-container">
                                <img src="./images/upgrades/flux-cap.png" alt="image of flux cap">
                            </div>
                            <a href="#">Flux Capacitor</a>
                        </div>
                        <div class="upgrade-card">
                            <div class="card-img-container">
                                <img src="./images/upgrades/flame.jpg" alt="image of flame">
                            </div>
                            <a href="#">Flame Decals</a>
                        </div>
                    </div>
                    <div class="upgrades-row2">
                        <div class="upgrade-card">
                            <div class="card-img-container">
                                <img src="./images/upgrades/bumper_sticker.jpg" alt="image of flux cap">
                            </div>
                            <a href="#">Bumper Stickers</a>
                        </div>
                        <div class="upgrade-card">
                            <div class="card-img-container">
                                <img src="./images/upgrades/hub-cap.jpg" alt="image of flame">
                            </div>
                            <a href="#">Hub Caps</a>
                        </div>
                    </div>
                </div>
                <div class="reviews">
                    <h3>DMC Delorean Reviews</h3>
                    <ul>
                        <li>"So fast its almost like traveling in time." (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day." (4/5)</li>
                        <li>"80's livin and I love it!" (5/5)</li>
                    </ul>
                </div>
            </div>
        </div>

    <?php require './modules/footer.php'?>
</body>
</html>