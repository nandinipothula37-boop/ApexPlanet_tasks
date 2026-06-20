<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

<h2>
Welcome,
<?php echo $_SESSION['user']; ?>
🎉
</h2>

<p>
You have successfully logged in.
</p>

<a href="logout.php"
class="btn btn-danger">
Logout
</a>

</div>

</div>

</body>
</html>