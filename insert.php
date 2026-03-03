<?php
include "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$name = $_POST['name'];
$email = $_POST['email'];
$product = $_POST['product'];
$amount = $_POST['amount'];

$sql = "INSERT INTO users (name,email,product,amount)
        VALUES (:name,:email,:product,:amount)";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':name'=>$name,
    ':email'=>$email,
    ':product'=>$product,
    ':amount'=>$amount
]);

header("Location: landing.php");
}
?>