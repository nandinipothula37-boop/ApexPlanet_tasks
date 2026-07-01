<<?php
include 'db_connect.php';

$message = "";

if(isset($_POST['register']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $rawPassword = $_POST['password'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    if(strlen($name) < 3)
    {
        $message = "<div class='alert alert-danger'>
                    Name must be at least 3 characters.
                    </div>";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $message = "<div class='alert alert-danger'>
                    Invalid Email Address.
                    </div>";
    }
    elseif(strlen($rawPassword) < 6)
    {
        $message = "<div class='alert alert-danger'>
                    Password must be at least 6 characters.
                    </div>";
    }
    elseif(!preg_match('/^[0-9]{10}$/', $phone))
    {
        $message = "<div class='alert alert-danger'>
                    Phone number must contain 10 digits.
                    </div>";
    }
    else
    {
        $check = $conn->prepare(
            "SELECT id FROM users WHERE email=?"
        );

        $check->bind_param("s",$email);
        $check->execute();
        $check->store_result();

        if($check->num_rows > 0)
        {
            $message = "<div class='alert alert-danger'>
                        Email already exists.
                        </div>";
        }
        else
        {
            $password = password_hash(
                $rawPassword,
                PASSWORD_DEFAULT
            );

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
                $message = "<div class='alert alert-success'>
                            Registration Successful!
                            </div>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="css/style.css">

<script>
function validateForm()
{
    let name = document.forms["regForm"]["name"].value;
    let password = document.forms["regForm"]["password"].value;
    let phone = document.forms["regForm"]["phone"].value;

    if(name.length < 3)
    {
        alert("Name must be at least 3 characters");
        return false;
    }

    if(password.length < 6)
    {
        alert("Password must be at least 6 characters");
        return false;
    }

    if(phone.length != 10)
    {
        alert("Phone number must be 10 digits");
        return false;
    }

    return true;
}
</script>

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

<form method="POST"
      name="regForm"
      onsubmit="return validateForm()">

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
class="form-control"
required>
</div>

<div class="mb-3">
<label>Address</label>
<input type="text"
name="address"
class="form-control"
required>
</div>

<button type="submit"
name="register"
class="btn btn-success w-100">
<i class="bi bi-person-plus"></i> Register
</button>

</form>
<hr>

<div class="text-center mt-3">

<p class="text-muted">
Already have an account?
</p>

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