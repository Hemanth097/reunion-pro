<?php
$servername = "beastserver.mysql.database.azure.com";
$username = "admin123";
$password = "pollpro1@";
$dbname = "reunion_poll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
