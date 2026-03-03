<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PDO CRUD System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg,#ff9ecf,#ffc3e6,#ffe6f2);
    min-height: 100vh;
    font-family: 'Poppins', sans-serif;
}

.card {
    border-radius: 25px;
    box-shadow: 0 10px 30px rgba(255,105,180,0.3);
    border: none;
}

.table {
    border-radius: 15px;
    overflow: hidden;
}

.btn {
    border-radius: 20px;
    font-weight: 500;
}

.btn-success {
    background-color: #ff69b4;
    border: none;
}

.btn-success:hover {
    background-color: #ff1493;
}

.btn-warning {
    background-color: #ffb6c1;
    border: none;
    color: #000;
}

.btn-danger {
    background-color: #ff4d6d;
    border: none;
}

.form-control {
    border-radius: 15px;
    border: 2px solid #ffb6c1;
}

.form-control:focus {
    border-color: #ff69b4;
    box-shadow: 0 0 5px #ff69b4;
}

.table thead {
    background-color: #ff69b4;
    color: white;
}

h4 {
    font-weight: bold;
}
</style>
</head>

<body>

<div class="container py-5">

<div class="row g-4">

<!-- ADD USER CARD -->
<div class="col-md-4">
<div class="card p-4 bg-white text-dark">

<h4 class="mb-4 text-center" style="color:#ff1493;">💖 Add New User</h4>

<form action="insert.php" method="POST">
<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Product</label>
<input type="text" name="product" class="form-control" required>
</div>

<div class="mb-3">
<label>Amount</label>
<input type="number" step="0.01" name="amount" class="form-control" required>
</div>

<button class="btn btn-success w-100">✨ Add User</button>
</form>

</div>
</div>

<!-- USER LIST -->
<div class="col-md-8">
<div class="card p-4 bg-white text-dark">

<h4 class="mb-4 text-center" style="color:#ff1493;">🌸 User & Order List</h4>

<div class="table-responsive">
<table class="table table-hover align-middle text-center">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Product</th>
<th>Amount</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php
$stmt = $conn->query("SELECT * FROM users");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
?>
<tr>
<td><?= $row['users_id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['product'] ?></td>
<td>₱<?= number_format($row['amount'],2) ?></td>
<td>
<a href="update.php?users_id=<?= $row['users_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="delete.php?users_id=<?= $row['users_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

</div>
</div>

</div>
</div>

</body>
</html>