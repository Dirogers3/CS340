<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/header.php'; ?>
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