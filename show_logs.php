<?php
include 'config.php';

$sql = "SELECT users.name, logs.action, logs.timestamp FROM logs JOIN users ON logs.user_id = users.id";
$result = $conn->query($sql);

$logs = array();
while($row = $result->fetch_assoc()) {
    $logs[] = $row;
}

echo json_encode($logs);

$conn->close();
?>
