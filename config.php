<?php
$servername = "beastserver.mysql.database.azure.com";
$username = "admin123";
$password = "pollpro1@";
$dbname = "reunion_poll";

$connectionInfo = array("Database" => $dbname, "UID" => $username, "PWD" => $password);
$conn = sqlsrv_connect($servername, $connectionInfo);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
