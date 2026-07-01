<?php
include 'db_connect.php';

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Users</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

<h3>User Management</h3>

<a href="dashboard.php"
class="btn btn-light">
Back to Dashboard
</a>

</div>

<div class="card-body">

<table class="table table-bordered table-striped table-hover">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Address</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['address']; ?></td>

<td>

<a href="edit_user.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">
<i class="bi bi-pencil-square"></i> Edit

</a>

<a href="delete_user.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this user?');">
<i class="bi bi-trash"></i> Delete

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>