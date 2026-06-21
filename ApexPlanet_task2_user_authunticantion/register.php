<?php
include 'db_connect.php';

$message = "";

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $check = $conn->prepare(
    "SELECT id FROM users WHERE email=?"
    );

    $check->bind_param("s",$email);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0)
    {
        $message =
        "<div class='alert alert-danger'>
        Email already exists!
        </div>";
    }
    else
    {
        $stmt = $conn->prepare(
        "INSERT INTO users(name,email,password,phone,address)
        VALUES(?,?,?,?,?)"
        );

        $stmt->bind_param(
        "sssss",
        $name,
        $email,
        $password,
        $phone,
        $address
        );

        if($stmt->execute())
        {
            $message =
            "<div class='alert alert-success'>
            Registration Successful!
            </div>";
        }
    }
}
?>

<!DOCTYPE html>

<html>
<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-success text-white">
<h3>Create Account</h3>
</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">
<label>Name</label>
<input type="text"
name="name"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email"
name="email"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password"
name="password"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text"
name="phone"
class="form-control">
</div>

<div class="mb-3">
<label>Address</label>
<input type="text"
name="address"
class="form-control">
</div>

<button type="submit"
name="register"
class="btn btn-success w-100">
Register </button>

</form>

<hr>

<div class="text-center">

<h6 class="text-secondary">
Already Registered?
</h6>

<a href="login.php"
class="btn btn-outline-primary px-4">
Go to Login
</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>
</html>
