<?php

require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PDO CRUD System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* Girly Pink Theme */
body {
    background: linear-gradient(135deg, #ffe6f0, #ffb3d9, #ff80c2);
    min-height: 100vh;
    color: #3d0033;
}

.card {
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(255, 105, 180, 0.3);
    background-color: rgba(255, 240, 245, 0.95);
    border: 2px solid #ffb3d9;
}

.table {
    border-radius: 15px;
    overflow: hidden;
}

.table thead {
    background-color: #ffc0cb;
    color: #800040;
    font-weight: 700;
}

.table tbody tr:nth-child(odd) {
    background-color: rgba(255, 182, 193, 0.2);
}

.table tbody tr:nth-child(even) {
    background-color: rgba(255, 182, 193, 0.1);
}

.table tbody tr:hover {
    background-color: rgba(255, 182, 193, 0.3);
    transition: 0.3s;
}

.btn {
    border-radius: 10px;
    font-weight: 600;
    border: none;
    transition: all 0.3s ease;
}

.btn-success {
    background: linear-gradient(135deg, #ff69b4, #ff1493);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(135deg, #ff1493, #c71585);
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(255, 105, 180, 0.4);
}

.btn-warning {
    background: linear-gradient(135deg, #ffa500, #ff8c00);
    color: white;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #ff8c00, #ff6347);
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(255, 140, 0, 0.4);
}

.btn-danger {
    background: linear-gradient(135deg, #ff6b9d, #ff1493);
    color: white;
}

.btn-danger:hover {
    background: linear-gradient(135deg, #ff1493, #c71585);
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(255, 105, 180, 0.4);
}

.btn-secondary {
    background-color: #daa5b8;
    color: white;
}

.btn-secondary:hover {
    background-color: #c78fa5;
}

.form-control {
    border-radius: 10px;
    border: 2px solid #ffb3d9;
    background-color: rgba(255, 255, 255, 0.8);
    color: #3d0033;
}

.form-control:focus {
    border-color: #ff69b4;
    background-color: rgba(255, 255, 255, 0.95);
    box-shadow: 0 0 0 0.2rem rgba(255, 105, 180, 0.25);
    color: #3d0033;
}

.form-label {
    color: #800040;
    font-weight: 600;
}

h2, h3, h4 {
    color: #c71585;
    font-weight: 700;
}

.alert {
    border-radius: 10px;
    border: 2px solid #ffb3d9;
}
</style>
</head>

<body>

<div class="container-fluid py-5">

<?php if (isset($_GET['added'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>✓ Success!</strong> User added successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php elseif (isset($_GET['updated'])): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>✓ Updated!</strong> User updated successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php elseif (isset($_GET['deleted'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>✓ Deleted!</strong> User deleted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<h2 class="mb-4 text-center">💕 PDO CRUD System</h2>

<div class="row g-4">

<!-- FORM SECTION -->
<div class="col-lg-5">
<div class="card p-4">

<?php

// CHECK IF EDIT MODE
$editUser = null;

if (isset($_GET['edit'])) {
  $users_id = $_GET['edit'];
  $stmt = $pdo->prepare("SELECT u.*, o.orders_id, o.product, o.amount FROM users u LEFT JOIN orders o ON u.users_id = o.users_id WHERE u.users_id = ?");
  $stmt->execute([$users_id]);
  $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<h4 class="mb-4"><?= $editUser ? '✏️ Update User' : '➕ Add New User' ?></h4>

<form method="POST">

  <?php if (!empty($editUser)): ?>
    <input type="hidden" name="users_id" value="<?= htmlspecialchars($editUser['users_id']) ?>">
  <?php endif; ?>

  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="<?= !empty($editUser) ? htmlspecialchars($editUser['name']) : '' ?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="<?= !empty($editUser) ? htmlspecialchars($editUser['email']) : '' ?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Product</label>
    <input type="text" name="product" class="form-control" value="<?= !empty($editUser) ? htmlspecialchars($editUser['product']) : '' ?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Amount</label>
    <input type="number" step="0.01" name="amount" class="form-control" value="<?= !empty($editUser) ? htmlspecialchars($editUser['amount']) : '' ?>" required>
  </div>

  <div class="d-grid gap-2">
    <?php if (!empty($editUser)): ?>
      <button type="submit" name="update" class="btn btn-warning">Update</button>
      <a href="landing.php" class="btn btn-secondary">Cancel</a>
    <?php else: ?>
      <button type="submit" name="add" class="btn btn-success">Add User</button>
    <?php endif; ?>
  </div>

</form>

</div>
</div>

<!-- USER LIST SECTION -->
<div class="col-lg-7">
<div class="card p-4">

<h4 class="mb-4">💖 User & Order List</h4>

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
<?php foreach ($users as $user): ?>
<tr>
<td><?= htmlspecialchars($user['users_id']) ?></td>
<td><?= htmlspecialchars($user['name']) ?></td>
<td><?= htmlspecialchars($user['email']) ?></td>
<td><?= isset($user['product']) ? htmlspecialchars($user['product']) : '-' ?></td>
<td><?= isset($user['amount']) && $user['amount'] !== null ? '$' . number_format($user['amount'], 2) : '-' ?></td>
<td>
<a href="?edit=<?= htmlspecialchars($user['users_id']) ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="delete.php?users_id=<?= htmlspecialchars($user['users_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

</div>
</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
