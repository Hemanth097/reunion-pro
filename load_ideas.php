<?php
include 'config.php';

$sql = "SELECT * FROM ideas";
$stmt = sqlsrv_query($conn, $sql);

$ideas = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $ideas[] = $row;
}

echo json_encode($ideas);

sqlsrv_close($conn);
?>
