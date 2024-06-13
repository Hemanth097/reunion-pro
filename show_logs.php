<?php
include 'config.php';

$sql = "SELECT users.name, logs.action, logs.timestamp FROM logs JOIN users ON logs.user_id = users.id";
$stmt = sqlsrv_query($conn, $sql);

$logs = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $logs[] = $row;
}

echo json_encode($logs);

sqlsrv_close($conn);
?>
