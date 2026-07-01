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

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


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

<div class="mb-3">
    <a href="profile.php"
    class="btn btn-info w-100">
    <i class="bi bi-person-circle"></i> Profile
    </a>
</div>

<div class="mb-3">
    <a href="weather.php"
    class="btn btn-success w-100">
    <i class="bi bi-cloud-sun"></i> Weather
    </a>
</div>

<div class="mb-3">
    <a href="manage_users.php"
    class="btn btn-primary w-100">
    <i class="bi bi-people-fill"></i> Manage Users
    </a>
</div>

<div class="mb-3">
    <a href="logout.php"
    class="btn btn-danger w-100">
    <i class="bi bi-box-arrow-right"></i> Logout
    </a>

</div>
</div>

</div>

</body>
</html>