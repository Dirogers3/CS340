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
                <a class="blackfont" href="/phpmotors/vehicles/index.php?action=add-classification">Add Classification Page</a>
            </li>
        </ul>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>
</body>

</html>