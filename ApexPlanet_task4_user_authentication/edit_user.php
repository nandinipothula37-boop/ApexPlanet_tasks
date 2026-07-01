<?php
include 'db_connect.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $conn->query("
    UPDATE users
    SET
    name='$name',
    email='$email',
    phone='$phone',
    address='$address'
    WHERE id=$id
    ");

    header("Location: manage_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">
<h3>Edit User</h3>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Name</label>
<input type="text"
name="name"
value="<?php echo $user['name']; ?>"
class="form-control">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email"
name="email"
value="<?php echo $user['email']; ?>"
class="form-control">
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text"
name="phone"
value="<?php echo $user['phone']; ?>"
class="form-control">
</div>

<div class="mb-3">
<label>Address</label>
<input type="text"
name="address"
value="<?php echo $user['address']; ?>"
class="form-control">
</div>

<button type="submit"
name="update"
class="btn btn-warning">
Update User
</button>

</form>

</div>

</div>

</div>

</body>
</html>