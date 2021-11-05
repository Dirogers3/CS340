<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/header.php'; ?>
<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <div class="main_content">
        <h1>Add Car Classification</h1>
        <?php
                    if (isset($message)) {
                    echo $message;
                    }
                    ?>
        <form action="/phpmotors/vehicles/index.php" method="POST">
            <label for="classification">Classification Name</label><br>
            <span>*Classification name must be under 30 characters.</span><br>
            <input type="text" name="classification" id="classification" maxlength="30" required>
            <br>
            <input type="submit" value="Add Classification">
            <input type="hidden" name="action" value="addClassification">
        </form>
    </div>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>