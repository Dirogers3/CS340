<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}

?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/header.php'; ?>
<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <h2>Vehicle Management</h2>
    <ul>
        <li>
            <a class="blackfont" href="/phpmotors/vehicles/index.php?action=add-vehicle">Add Vehicle Page</a><br>
        </li>
        <li>
            <a class="blackfont" href="/phpmotors/vehicles/index.php?action=add-classification">Add Classification
                Page</a>
        </li>
    </ul>
    <?php
            if (isset($message)) { 
            echo $message; 
            } 
            if (isset($classificationList)) { 
            echo '<h2>Vehicles By Classification</h2>'; 
            echo '<p>Choose a classification to see those vehicles</p>'; 
            echo $classificationList; 
            }
        ?>
    <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <table id="inventoryDisplay"></table>

</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>
<script src="../js/inventory.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>``