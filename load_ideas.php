<?php
include 'config.php';

header('Content-Type: application/json');

$sql = "SELECT * FROM ideas";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    echo json_encode(array("error" => print_r(sqlsrv_errors(), true)));
    exit;
}

$ideas = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $ideas[] = $row;
}

echo json_encode($ideas);

sqlsrv_close($conn);
?>
