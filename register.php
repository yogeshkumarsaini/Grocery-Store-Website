<?php

session_start();
include 'config/db.php';

$message = '';

if(isset($_POST['register']))
{
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password != $confirm_password)
    {
        $message = "Passwords do not match";
    }
    else
    {
        $check = mysqli_query($conn,
        "SELECT id FROM users WHERE email='$email'");

        if(mysqli_num_rows($check) > 0)
        {
            $message = "Email already exists";
        }
        else
        {
            $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

            $query = "INSERT INTO users(name,email,password)
                      VALUES('$name','$email','$hashedPassword')";

            if(mysqli_query($conn,$query))
            {
                $_SESSION['success'] = "Registration Successful";
                header("Location: login.php");
                exit();
            }
            else
            {
                $message = "Something went wrong";
            }
        }
    }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-success text-white">
<h4>Create Account</h4>
</div>

<div class="card-body">

<?php if($message!=''){ ?>
<div class="alert alert-danger">
<?php echo $message; ?>
</div>
<?php } ?>

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
<label>Confirm Password</label>
<input type="password"
name="confirm_password"
class="form-control"
required>
</div>

<button type="submit"
name="register"
class="btn btn-success">
Register
</button>

</form>

<p class="mt-3">
Already have an account?
<a href="login.php">Login</a>
</p>

</div>

</div>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>