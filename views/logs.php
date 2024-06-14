<?php
include '../includes/db.php';
include '../includes/functions.php';

$logs = getLogs();
?>

<?php include 'header.php'; ?>
<div class="container">
    <h2>Logs</h2>
    <ul class="list-group">
        <?php foreach ($logs as $log): ?>
            <li class="list-group-item">
                <?php echo htmlspecialchars($log['user_name']); ?> 
                <?php echo htmlspecialchars($log['option_text']); ?> 
                at <?php echo htmlspecialchars($log['voted_at']->format('Y-m-d H:i:s')); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php include 'footer.php'; ?>
