<?php
session_start();

$cart_count = 0;

if(isset($_SESSION['cart']))
{
    foreach($_SESSION['cart'] as $qty)
    {
        $cart_count += $qty;
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">

<div class="container">

<a class="navbar-brand fw-bold" href="index.php">
    <i class="fas fa-shopping-basket"></i>
    Fresh Grocery
</a>

<button
    class="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#menu">

    <span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
    <a class="nav-link" href="index.php">
        Home
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="products.php">
        Products
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="cart.php">
        Cart
        <span class="badge bg-warning text-dark">
            <?php echo $cart_count; ?>
        </span>
    </a>
</li>

<?php if(isset($_SESSION['user_id'])) { ?>

    <li class="nav-item">
        <a class="nav-link" href="orders.php">
            My Orders
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link">
            Welcome,
            <?php echo htmlspecialchars($_SESSION['user_name']); ?>
        </a>
    </li>

    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>

        <li class="nav-item">
            <a class="nav-link" href="admin/dashboard.php">
                Admin Panel
            </a>
        </li>

    <?php } ?>

    <li class="nav-item">
        <a class="nav-link" href="logout.php">
            Logout
        </a>
    </li>

<?php } else { ?>

    <li class="nav-item">
        <a class="nav-link" href="login.php">
            Login
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="register.php">
            Register
        </a>
    </li>

<?php } ?>

</ul>

</div>

</div>

</nav>