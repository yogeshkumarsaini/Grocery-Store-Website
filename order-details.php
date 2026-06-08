<?php

include 'includes/auth.php';
include 'config/db.php';

$order_id = (int)$_GET['id'];
$user_id  = $_SESSION['user_id'];

//  Verify Order Belongs To Logged-In User

$orderQuery = mysqli_query(
    $conn,
    "SELECT * FROM orders
     WHERE id='$order_id'
     AND user_id='$user_id'"
);

$order = mysqli_fetch_assoc($orderQuery);

if(!$order)
{
    die("
    <div class='container mt-5'>
        <div class='alert alert-danger'>
            Order Not Found Or Access Denied.
        </div>
        <a href='orders.php' class='btn btn-secondary'>
            Back To Orders
        </a>
    </div>
    ");
}

//  Fetch Order Items

$items = mysqli_query(
    $conn,
    "SELECT oi.*, p.product_name
     FROM order_items oi
     JOIN products p
     ON p.id = oi.product_id
     WHERE oi.order_id='$order_id'"
);

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

    <h2>Order #<?php echo $order_id; ?></h2>

    <div class="mb-3">
        <strong>Status:</strong>
        <?php echo $order['status']; ?>
        <br>

        <strong>Total Amount:</strong>
        ₹ <?php echo number_format($order['total_amount'],2); ?>
    </div>

    <table class="table table-bordered">

        <thead class="table-success">

            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>

        </thead>

        <tbody>

        <?php while($item = mysqli_fetch_assoc($items)){ ?>

            <tr>

                <td>
                    <?php echo htmlspecialchars($item['product_name']); ?>
                </td>

                <td>
                    <?php echo $item['quantity']; ?>
                </td>

                <td>
                    ₹ <?php echo number_format($item['price'],2); ?>
                </td>

                <td>
                    ₹ <?php echo number_format(
                        $item['price'] * $item['quantity'],
                        2
                    ); ?>
                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

    <a href="orders.php"
       class="btn btn-secondary">
       Back
    </a>

</div>

<?php include 'includes/footer.php'; ?>