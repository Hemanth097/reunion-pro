<?php
$serverName = "beastpollserver.database.windows.net";
$connectionOptions = array(
    "Database" => "reunion_poll",
    "Uid" => "admin123",
    "PWD" => "pollPro1@"
);

//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if (!$conn) {
    $errors = sqlsrv_errors();
    $errorMsg = "";
    foreach ($errors as $error) {
        $errorMsg .= "SQLSTATE: ".$error['SQLSTATE']."; Code: ".$error['code']."; Message: ".$error['message']."<br/>";
    }
    die("Connection failed: " . $errorMsg);
}
?>