<?php
include '../includes/db.php';

function clearData() {
    global $conn;

    // Disable foreign key checks
    $sql = "ALTER TABLE Votes NOCHECK CONSTRAINT ALL";
    sqlsrv_query($conn, $sql);
    $sql = "ALTER TABLE PollOptions NOCHECK CONSTRAINT ALL";
    sqlsrv_query($conn, $sql);

    // Delete all data in the correct order
    $tables = ['Votes', 'PollOptions', 'Users'];

    foreach ($tables as $table) {
        $sql = "DELETE FROM $table";
        if (sqlsrv_query($conn, $sql) === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    // Re-enable foreign key checks
    $sql = "ALTER TABLE Votes CHECK CONSTRAINT ALL";
    sqlsrv_query($conn, $sql);
    $sql = "ALTER TABLE PollOptions CHECK CONSTRAINT ALL";
    sqlsrv_query($conn, $sql);

    echo "Data cleared successfully.";
}

clearData();
?>
