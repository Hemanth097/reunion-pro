<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"));
$name = $data->name;
$idea = $data->idea;

$sql = "INSERT INTO users (name) OUTPUT INSERTED.id VALUES (?)";
$params = array($name);
$stmt = sqlsrv_query($conn, $sql, $params);
sqlsrv_fetch($stmt);
$userId = sqlsrv_get_field($stmt, 0);

$sql = "INSERT INTO ideas (idea) OUTPUT INSERTED.id VALUES (?)";
$params = array($idea);
$stmt = sqlsrv_query($conn, $sql, $params);
sqlsrv_fetch($stmt);
$ideaId = sqlsrv_get_field($stmt, 0);

$sql = "INSERT INTO logs (user_id, action) VALUES (?, ?)";
$params = array($userId, "submitted idea: $idea");
sqlsrv_query($conn, $sql, $params);

sqlsrv_close($conn);
?>
