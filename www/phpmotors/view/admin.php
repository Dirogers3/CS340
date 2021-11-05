<?php
//check to see if user is logged in
if ($_SESSION['loggedin'] != TRUE) {
    header('Location: /phpmotors/');
}
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/header.php'; ?>
<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <?php
    $clientLastname = $_SESSION['clientData']['clientLastname'];
    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $clientEmail = $_SESSION['clientData']['clientEmail'];
    $clientLevel = $_SESSION['clientData']['clientLevel'];
    echo "<h1>Logged in: $clientFirstname $clientLastname</h1>";
    echo "<p>You are logged in.</p>";
    echo "<ul>
            <li>First Name: $clientFirstname</li>
            <li>Last Name: $clientLastname</li>
            <li>Email: $clientEmail</li>
        </ul>";
    if($_SESSION['clientData']['clientLevel']>1){
        echo '<h3>Inventory Management</h3>
        <p>Use this link to manage the inventory.</p>
        <a href="/phpmotors/vehicles">Vehicle Management</a>';   
    }
    ?>

</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>
</body>

</html>