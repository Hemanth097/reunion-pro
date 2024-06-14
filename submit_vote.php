<?php
include 'includes/db.php';
include 'includes/functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['option_id'])) {
    $optionId = $_POST['option_id'];
    $userName = $_SESSION['username'];
    $sql = "SELECT id FROM Users WHERE name = ?";
    $stmt = sqlsrv_query($conn, $sql, array($userName));
    $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $userId = $user['id'];
    
    submitVote($userId, $optionId);
    
    echo json_encode(['status' => 'success']);
}
?>
