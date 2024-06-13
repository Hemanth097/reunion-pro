<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$name = $data->name;

$conn->query("INSERT INTO users (name) VALUES ('$name') ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)");
$userId = $conn->insert_id;

$conn->query("UPDATE ideas SET votes = votes + 1 WHERE id = $id");

$conn->query("INSERT INTO logs (user_id, action) VALUES ($userId, 'voted for idea ID: $id')");

$conn->close();
?>
