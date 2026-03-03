<?php
require 'config.php';

if (isset($_GET['users_id'])) {
    $user_id = $_GET['users_id'];

    $stmt = $pdo->prepare("DELETE FROM users WHERE users_id = ?");
    $stmt->execute([$user_id]);


    header('Location: landing.php?deleted');
    exit;
}
?>
