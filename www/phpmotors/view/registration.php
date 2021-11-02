<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/header.php'; ?>
<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <h2>Registration</h2>

    <div class="loginform" action="/phpmotors/accounts/index.php">
        <?php
        if (isset($message)) {
        echo $message;
        }
    ?>
        <form method="post" action="/phpmotors/accounts/index.php">
            <label for="clientFirstname">First Name</label><br>
            <input name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> type="text" required placeholder="Enter First name"><br>
            <label for="clientLastname">Last Name</label><br>
            <input name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientFirstname'";}  ?> type="text" required placeholder="Enter Last name"><br>
            <label for="clientEmail">Email</label><br>
            <input name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> type="email" required placeholder="Enter Email"><br><br>
            <label for="clientPassword">Password (Passwords must be at least 8 characters and contain at least 1 number,
                1 captital letter and 1 special character)</label><br>
            <input name="clientPassword" id="clientPassword" type="password" placeholder="Enter a Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
            <input type="submit" value="Register">

            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="register">
        </form>
    </div>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>
</body>

</html>