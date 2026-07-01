<?php

session_start();
include 'db_connect.php';

$message = "";

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare(
    "SELECT id,name,password
    FROM users
    WHERE email=?"
    );

    $stmt->bind_param("s",$email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
        $user = $result->fetch_assoc();

        if(password_verify(
            $password,
            $user['password']
        ))
        {
            $_SESSION['user']
            = $user['name'];

            header(
            "Location: dashboard.php"
            );

            exit();
        }
        else
        {
            $message =
            "<div class='alert alert-danger'>
            Invalid Password
            </div>";
        }
    }
    else
    {
        $message =
        "<div class='alert alert-danger'>
        User Not Found
        </div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">
<h3>User Login</h3>
</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

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
name="login"
class="btn btn-primary w-100">
<i class="bi bi-box-arrow-in-right"></i> Login

</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>