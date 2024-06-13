<?php
include 'config.php';

$sql = "SELECT * FROM ideas";
$result = $conn->query($sql);

$ideas = array();
while($row = $result->fetch_assoc()) {
    $ideas[] = $row;
}

echo json_encode($ideas);

$conn->close();
?>
