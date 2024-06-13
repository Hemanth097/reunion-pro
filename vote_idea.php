<?php
include 'config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$name = $data['name'];

if (empty($id) || empty($name)) {
    echo json_encode(array("error" => "ID and Name are required."));
    exit;
}

$sql = "INSERT INTO users (name) OUTPUT INSERTED.id VALUES (?)";
$params = array($name);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(array("error" => print_r(sqlsrv_errors(), true)));
    exit;
}

sqlsrv_fetch($stmt);
$userId = sqlsrv_get_field($stmt, 0);

$sql = "UPDATE ideas SET votes = votes + 1 WHERE id = ?";
$params = array($id);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(array("error" => print_r(sqlsrv_errors(), true)));
    exit;
}

$sql = "INSERT INTO logs (user_id, action) VALUES (?, ?)";
$params = array($userId, "voted for idea ID: $id");
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(array("error" => print_r(sqlsrv_errors(), true)));
    exit;
}

echo json_encode(array("success" => true));

sqlsrv_close($conn);
?>
