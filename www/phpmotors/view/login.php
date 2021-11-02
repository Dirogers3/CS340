<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/header.php'; ?>
<nav>
    <?php echo $navList; ?>
</nav>
<h1>Login</h1>
<div class="loginform">
    <h1>PHP Motors Login</h1>
    <?php
        if (isset($message)) {
            echo $message;
        }
    ?>
    <form action="/phpmotors/accounts/index.php" method="post">
        <div>
        <label for="clientEmail">Email</label><br>
        <input name="clientEmail" id="clientEmail" placeholder="Enter Email" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
        </div>
        <div>
        <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> <br>

            <label for="userPassword">Password</label><br>
            <input name="userPassword" type="password" id="userPassword" placeholder="Enter Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
        </div>
        <input type="submit" value="Login">
        <input type="hidden" name="action" value="Login">
        <p>No Account? <a href="/phpmotors/accounts/?action=registration">Sign-up</a></p>
    </form>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>
</body>

</html>