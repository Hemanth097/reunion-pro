<?php
include 'config.php';

header('Content-Type: application/json');

$sql = "SELECT users.name, logs.action, logs.timestamp FROM logs JOIN users ON logs.user_id = users.id";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    echo json_encode(array("error" => print_r(sqlsrv_errors(), true)));
    exit;
}

$logs = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $logs[] = $row;
}

echo json_encode($logs);

sqlsrv_close($conn);
?>
