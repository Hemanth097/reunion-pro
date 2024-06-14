<?php
include '../includes/db.php';
include '../includes/functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
    $sql = "SELECT * FROM Users WHERE name = ?";
    $stmt = sqlsrv_query($conn, $sql, array($_SESSION['username']));
    if (sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) === null) {
        $sql = "INSERT INTO Users (name) VALUES (?)";
        sqlsrv_query($conn, $sql, array($_SESSION['username']));
    }
}

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$userName = $_SESSION['username'];
$sql = "SELECT id FROM Users WHERE name = ?";
$stmt = sqlsrv_query($conn, $sql, array($userName));
$user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$userId = $user['id'];

$pollOptions = getPollOptions();
?>
<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($userName); ?>!</h2>
    <div class="card mt-4">
        <div class="card-header">
            <h3>Poll Options</h3>
        </div>
        <ul class="list-group list-group-flush" id="poll-options">
            <?php foreach ($pollOptions as $option): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo htmlspecialchars($option['option_text']); ?> - <span class="badge badge-primary badge-pill"><?php echo $option['vote_count']; ?> votes</span></span>
                    <button class="btn btn-primary vote-button" data-option-id="<?php echo $option['id']; ?>">Vote</button>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            <h3>Add New Option</h3>
        </div>
        <div class="card-body">
            <form id="add-option-form">
                <div class="form-group">
                    <input type="text" id="option_text" name="option_text" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success btn-block">Add</button>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
