<?php
require 'config.php';

$stmt = $pdo->query("SELECT u.users_id, u.name, u.email, o.orders_id, o.product, o.amount
    FROM users u
    LEFT JOIN orders o ON u.users_id = o.users_id"
);


$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
