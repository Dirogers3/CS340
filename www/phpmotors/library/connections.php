<?php
function phpmotorsConnect() {
    $server = 'mysql';
    $dbname = 'phpmotors';
    $username = 'iClient';
    $password = 'asdfqwer';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    try {
        $link = new PDO($dsn, $username, $password, $options);
        echo "The Server is connected and working!";
        return $link;
    } catch (PDOException $e) {
        header('Location: /phpmotors/view/500.php');
        exit;
    }
}
phpmotorsConnect();
?>
