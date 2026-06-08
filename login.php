<<<<<<< HEAD
<?php

session_start();
include 'config/db.php';

$message = '';

if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($query)==1)
    {
        $user = mysqli_fetch_assoc($query);

        if(password_verify($password,$user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if($user['role']=='admin')
            {
                header("Location: admin/dashboard.php");
            }
            else
            {
                header("Location: index.php");
            }

            exit();
        }
        else
        {
            $message = "Invalid Password";
        }
    }
    else
    {
        $message = "User Not Found";
    }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-success text-white">
<h4>Login</h4>
</div>

<div class="card-body">

<?php
if(isset($_SESSION['success']))
{
?>
<div class="alert alert-success">
<?php
echo $_SESSION['success'];
unset($_SESSION['success']);
?>
</div>
<?php } ?>

<?php if($message!=''){ ?>
<div class="alert alert-danger">
<?php echo $message; ?>
</div>
<?php } ?>

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
class="btn btn-success">
Login
</button>

</form>

<p class="mt-3">
New User?
<a href="register.php">Register Here</a>
</p>

</div>

</div>

</div>

</div>

</div>

=======
<?php

session_start();
include 'config/db.php';

$message = '';

if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($query)==1)
    {
        $user = mysqli_fetch_assoc($query);

        if(password_verify($password,$user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if($user['role']=='admin')
            {
                header("Location: admin/dashboard.php");
            }
            else
            {
                header("Location: index.php");
            }

            exit();
        }
        else
        {
            $message = "Invalid Password";
        }
    }
    else
    {
        $message = "User Not Found";
    }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-success text-white">
<h4>Login</h4>
</div>

<div class="card-body">

<?php
if(isset($_SESSION['success']))
{
?>
<div class="alert alert-success">
<?php
echo $_SESSION['success'];
unset($_SESSION['success']);
?>
</div>
<?php } ?>

<?php if($message!=''){ ?>
<div class="alert alert-danger">
<?php echo $message; ?>
</div>
<?php } ?>

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
class="btn btn-success">
Login
</button>

</form>

<p class="mt-3">
New User?
<a href="register.php">Register Here</a>
</p>

</div>

</div>

</div>

</div>

</div>

>>>>>>> 01c2f9787f72f05f6df1b4565ac1f76af4d236a3
<?php include 'includes/footer.php'; ?>