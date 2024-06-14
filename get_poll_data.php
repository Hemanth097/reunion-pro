<?php
include 'includes/db.php';
include 'includes/functions.php';

$pollOptions = getPollOptions();
echo json_encode($pollOptions);
?>
