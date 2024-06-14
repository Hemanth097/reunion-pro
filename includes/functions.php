<?php
include 'db.php';

function getPollOptions() {
    global $conn;
    $sql = "SELECT * FROM PollOptions";
    $stmt = sqlsrv_query($conn, $sql);
    $options = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $options[] = $row;
    }
    return $options;
}

function addPollOption($optionText, $userId) {
    global $conn;
    $sql = "INSERT INTO PollOptions (option_text, created_by) VALUES (?, ?)";
    $params = array($optionText, $userId);
    sqlsrv_query($conn, $sql, $params);
}

function submitVote($userId, $optionId) {
    global $conn;
    $sql = "INSERT INTO Votes (user_id, option_id) VALUES (?, ?)";
    $params = array($userId, $optionId);
    sqlsrv_query($conn, $sql, $params);
}

function getLogs() {
    global $conn;
    $sql = "SELECT u.name AS user_name, p.option_text, v.voted_at
            FROM Votes v
            JOIN Users u ON v.user_id = u.id
            JOIN PollOptions p ON v.option_id = p.id
            UNION
            SELECT u.name AS user_name, p.option_text, p.created_at AS voted_at
            FROM PollOptions p
            JOIN Users u ON p.created_by = u.id
            ORDER BY voted_at DESC";
    $stmt = sqlsrv_query($conn, $sql);
    $logs = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $logs[] = $row;
    }
    return $logs;
}
?>
