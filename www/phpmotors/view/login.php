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
            <label for="Username">Username</label>
            <input name="Username" type="text" id="Username" placeholder="username" required>
        </div>
        <div>
            <label for="userPassword">Password</label>
            <input name="userPasswrod" type="text" id="userPassword" placeholder="password" required>
        </div>
        <button>Login</button>
        <p>No Account? <a href="/phpmotors/accounts/?action=registration">Sign-up</a></p>
    </form>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>
</body>

</html>