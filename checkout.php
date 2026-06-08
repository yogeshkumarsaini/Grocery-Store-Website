<?php

include 'includes/auth.php';
include 'config/db.php';
include 'config/razorpay.php';

if(empty($_SESSION['cart']))
{
    header("Location: cart.php");
    exit();
}

$total = 0;

foreach($_SESSION['cart'] as $pid=>$qty)
{
$product = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM products WHERE id='$pid'")
);

$total += ($product['price'] * $qty);
}

if(isset($_POST['place_order']))
{
    $user_id = $_SESSION['user_id'];

    mysqli_query($conn,
    "INSERT INTO orders(user_id,total_amount,status)
    VALUES('$user_id','$total','Pending')");

    $order_id = mysqli_insert_id($conn);

    foreach($_SESSION['cart'] as $pid=>$qty)
    {
        $product = mysqli_fetch_assoc(
        mysqli_query($conn,
        "SELECT * FROM products WHERE id='$pid'")
        );

        mysqli_query($conn,
        "INSERT INTO order_items
        (order_id,product_id,quantity,price)
        VALUES
        (
        '$order_id',
        '$pid',
        '$qty',
        '".$product['price']."'
        )");

        mysqli_query($conn,
        "UPDATE products
        SET stock = stock - $qty
        WHERE id='$pid'");
    }

    unset($_SESSION['cart']);

    header("Location: orders.php?success=1");
    exit();
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card shadow">

<div class="card-header bg-success text-white">
Order Summary
</div>

<div class="card-body">

<table class="table">

<tr>
<th>Total Amount</th>
<td>₹ <?php echo number_format($total,2); ?></td>
</tr>

<tr>
<th>Payment Method</th>
<td>Cash On Delivery</td>
</tr>

</table>

<form method="POST">

<button
type="submit"
name="place_order"
class="btn btn-success">

Cash On Delivery

</button>

<button
type="button"
id="rzp-button1"
class="btn btn-primary">

Pay Online

</button>

</form>

</div>

</div>

</div>

</div>

</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

var options = {

    "key": "<?php echo $keyId; ?>",

    "amount": <?php echo $total * 100; ?>,

    "currency": "INR",

    "name": "Fresh Grocery",

    "description": "Order Payment",

    "handler": function(response){

        alert(
            "Payment Successful : " +
            response.razorpay_payment_id
        );

        window.location.href =
        "payment-success.php?payment_id=" +
        response.razorpay_payment_id;
    }
};

var rzp1 = new Razorpay(options);

document
.getElementById('rzp-button1')
.onclick = function(e){

    rzp1.open();

    e.preventDefault();
};

</script>

<?php include 'includes/footer.php'; ?>