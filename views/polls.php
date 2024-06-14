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
        <ul class="list-group list-group-flush">
            <?php foreach ($pollOptions as $option): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo htmlspecialchars($option['option_text']); ?>
                    <form action="../submit_vote.php" method="POST" class="form-inline">
                        <input type="hidden" name="option_id" value="<?php echo $option['id']; ?>">
                        <button type="submit" class="btn btn-primary">Vote</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            <h3>Add New Option</h3>
        </div>
        <div class="card-body">
            <form action="../add_option.php" method="POST">
                <div class="form-group">
                    <input type="text" name="option_text" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success btn-block">Add</button>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
