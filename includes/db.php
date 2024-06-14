<?php
$serverName = "your_server_name";
$connectionOptions = array(
    "Database" => "your_database_name",
    "Uid" => "your_username",
    "PWD" => "your_password"
);

//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if(!$conn) {
    die("Connection failed: " . sqlsrv_errors());
}
?>
