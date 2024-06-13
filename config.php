<?php
$servername = "beastpollserver.database.windows.net";
$username = "admin123";
$password = "pollPro1@";
$dbname = "reunion_poll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
