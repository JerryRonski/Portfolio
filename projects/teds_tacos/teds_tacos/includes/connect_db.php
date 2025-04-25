<!-- connect to database -->

<?php
$servername = "mysql:host=localhost;dbname=teds_tacos";
$username = "root";
$password = "";
try {
    $db = new PDO($servername, $username, $password);
    //echo "Connected Successfully"; // testing
} catch (PDOException $e) {
    echo "Connection Failed" . $e->getMessage();
}
?>