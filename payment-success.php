<?php

session_start();

include 'config/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$payment_id = $_GET['payment_id'] ?? '';

if(empty($payment_id))
{
    die("Invalid Payment");
}

if(empty($_SESSION['cart']))
{
    die("Cart is empty");
}

$user_id = $_SESSION['user_id'];

$total = 0;

foreach($_SESSION['cart'] as $pid => $qty)
{
    $product = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT * FROM products WHERE id='$pid'"
        )
    );

    $total += ($product['price'] * $qty);
}

/*
|--------------------------------------------------------------------------
| Create Order
|--------------------------------------------------------------------------
*/

mysqli_query(
    $conn,
    "INSERT INTO orders
    (
        user_id,
        total_amount,
        status,
        payment_id,
        payment_status
    )
    VALUES
    (
        '$user_id',
        '$total',
        'Completed',
        '$payment_id',
        'Paid'
    )"
);

$order_id = mysqli_insert_id($conn);

/*
|--------------------------------------------------------------------------
| Save Order Items
|--------------------------------------------------------------------------
*/

foreach($_SESSION['cart'] as $pid => $qty)
{
    $product = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT * FROM products WHERE id='$pid'"
        )
    );

    mysqli_query(
        $conn,
        "INSERT INTO order_items
        (
            order_id,
            product_id,
            quantity,
            price
        )
        VALUES
        (
            '$order_id',
            '$pid',
            '$qty',
            '".$product['price']."'
        )"
    );

    mysqli_query(
        $conn,
        "UPDATE products
         SET stock = stock - $qty
         WHERE id='$pid'"
    );
}

/*
|--------------------------------------------------------------------------
| Clear Cart
|--------------------------------------------------------------------------
*/

unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Success</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-body text-center">

<h2 class="text-success">
Payment Successful
</h2>

<p>
Payment ID:
<strong><?php echo htmlspecialchars($payment_id); ?></strong>
</p>

<p>
Order ID:
<strong>#<?php echo $order_id; ?></strong>
</p>

<a href="orders.php" class="btn btn-success">
View Orders
</a>

<a href="invoice.php?id=<?php echo $order_id; ?>" class="btn btn-primary">
Download Invoice
</a>

</div>

</div>

</div>

</body>
</html>