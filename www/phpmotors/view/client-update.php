<?php
    if (!isset($_SESSION['loggedin'])) {
        header('location: /phpmotors/');
    }
     include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/header.php'; ?>
<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <h1>Manage Account</h1>
                
                <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    }
                    if (isset($message)) {
                        echo $message;
                    }
                ?>
                <form method="post" action="/phpmotors/accounts/">
                        <h2>Update Account</h2>
                        <label for="clientFirstname">First Name</label> <br>
                        <input name="clientFirstname" id="clientFirstname" type="text" <?php if(isset($clientInfo['clientFirstname'])){ echo "value='$clientInfo[clientFirstname]'"; } elseif(isset($clientFirstname)){ echo "value='$clientFirstname'";} ?> required> <br>
                        <label for="clientLastname">Last Name</label> <br>
                        <input name="clientLastname" id="clientLastname" type="text" <?php if(isset($clientInfo['clientLastname'])){ echo "value='$clientInfo[clientLastname]'"; } elseif(isset($clientLastname)){ echo "value='$clientLastname'";} ?> required> <br>
                        <label for="clientEmail">Email</label> <br>
                        <input name="clientEmail" id="clientEmail" type="email" <?php if(isset($clientInfo['clientEmail'])){ echo "value='$clientInfo[clientEmail]'"; } elseif(isset($clientEmail)){ echo "value='$clientEmail'";} ?> required> <br>
                        <br>
                        <input type="submit" id="submit" value="Update">
                        <input type="hidden" name="action" value="updateAccount">
                        <input type="hidden" name="clientId" value="<?php echo $clientInfo['clientId'];?>">
                </form><br>
                <form method="post" action="/phpmotors/accounts/">
                        <h2>Update Password</h2>
                        <label for="clientPassword">New Password</label>
                        <br><span>Passwords must be at least 8 characters and contain at least 1 number,
                1 captital letter and 1 special character</span>
                        <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                        <br>
                        <input type="submit" id="submit" value="Update Password">
                        <input type="hidden" name="action" value="updatePassword">
                        <input type="hidden" name="clientId" value="<?php echo $clientInfo['clientId'];?>">
                </form>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>
</body>

</html>