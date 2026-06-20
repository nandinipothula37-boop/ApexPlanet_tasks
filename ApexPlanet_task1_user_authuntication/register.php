<?php
include 'db_connect.php';

$message = "";

if(isset($_POST['register']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

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
        "INSERT INTO users(name,email,password)
        VALUES(?,?,?)"
        );

        $stmt->bind_param(
        "sss",
        $name,
        $email,
        $password
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

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-5">

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

<button type="submit"
name="register"
class="btn btn-success w-100">
Register
</button>

</form>

<hr>

<a href="login.php">
Already have an account?
Login
</a>

</div>

</div>

</div>

</div>

</div>

</body>
</html>