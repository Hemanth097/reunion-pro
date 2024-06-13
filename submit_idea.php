<?php
include 'config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'];
$idea = $data['idea'];

if (empty($name) || empty($idea)) {
    echo json_encode(array("error" => "Name and Idea are required."));
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

$sql = "INSERT INTO ideas (idea) OUTPUT INSERTED.id VALUES (?)";
$params = array($idea);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(array("error" => print_r(sqlsrv_errors(), true)));
    exit;
}

sqlsrv_fetch($stmt);
$ideaId = sqlsrv_get_field($stmt, 0);

$sql = "INSERT INTO logs (user_id, action) VALUES (?, ?)";
$params = array($userId, "submitted idea: $idea");
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(array("error" => print_r(sqlsrv_errors(), true)));
    exit;
}

echo json_encode(array("success" => true));

sqlsrv_close($conn);
?>
