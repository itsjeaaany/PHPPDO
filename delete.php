<?php
include "config.php";

$id = $_GET['users_id'];

$stmt = $conn->prepare("DELETE FROM users WHERE users_id = :users_id");
$stmt->execute([':users_id'=>$users_id]);

header("Location: landing.php");
?>