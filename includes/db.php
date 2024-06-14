<?php
$serverName = "beastpollserver.database.windows.net";
$connectionOptions = array(
    "Database" => "reunion_poll",
    "Uid" => "admin123",
    "PWD" => "pollPro1@"
);

//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if(!$conn) {
    die("Connection failed: " . sqlsrv_errors());
}
?>
