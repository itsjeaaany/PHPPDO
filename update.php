<?php
include "config.php";

$id = $_GET['users_id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){

$name = $_POST['name'];
$email = $_POST['email'];
$product = $_POST['product'];
$amount = $_POST['amount'];

$sql = "UPDATE users SET 
        name=:name,
        email=:email,
        product=:product,
        amount=:amount
        WHERE users_id=:users_id";

$stmt = $conn->prepare($sql);
$stmt->execute([
':name'=>$name,
':email'=>$email,
':product'=>$product,
':amount'=>$amount,
':users_id'=>$users_id,
]);

header("Location: landing.php");
}

$stmt = $conn->prepare("SELECT * FROM users WHERE users_id=:users_id");
$stmt->execute([':users_id'=>$users_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>