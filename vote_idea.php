<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$name = $data->name;

$sql = "INSERT INTO users (name) OUTPUT INSERTED.id VALUES (?)";
$params = array($name);
$stmt = sqlsrv_query($conn, $sql, $params);
sqlsrv_fetch($stmt);
$userId = sqlsrv_get_field($stmt, 0);

$sql = "UPDATE ideas SET votes = votes + 1 WHERE id = ?";
$params = array($id);
sqlsrv_query($conn, $sql, $params);

$sql = "INSERT INTO logs (user_id, action) VALUES (?, ?)";
$params = array($userId, "voted for idea ID: $id");
sqlsrv_query($conn, $sql, $params);

sqlsrv_close($conn);
?>
