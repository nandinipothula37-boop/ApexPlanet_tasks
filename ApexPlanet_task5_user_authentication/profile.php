<?php
session_start();
include 'db_connect.php';

$email = $_SESSION['user'];

$result = $conn->query(
"SELECT * FROM users WHERE email='$email'"
);

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>

<html>
<head>

<title>My Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">
<h3>
<i class="bi bi-person-circle"></i>
My Profile
</h3>
</div>

<div class="card-body">

<p><strong>Name:</strong> <?php echo $user['name']; ?></p>

<p><strong>Email:</strong> <?php echo $user['email']; ?></p>

<p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>

<p><strong>Address:</strong> <?php echo $user['address']; ?></p>

<p><strong>Role:</strong> <?php echo $user['role']; ?></p>

<a href="dashboard.php"
class="btn btn-primary">
Back to Dashboard </a>

</div>

</div>

</div>

</body>
</html>
