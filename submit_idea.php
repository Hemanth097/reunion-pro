<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"));
$name = $data->name;
$idea = $data->idea;

$conn->query("INSERT INTO users (name) VALUES ('$name') ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)");
$userId = $conn->insert_id;

$conn->query("INSERT INTO ideas (idea) VALUES ('$idea')");
$ideaId = $conn->insert_id;

$conn->query("INSERT INTO logs (user_id, action) VALUES ($userId, 'submitted idea: $idea')");

$conn->close();
?>
