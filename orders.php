<<<<<<< HEAD
<?php

include 'includes/auth.php';
include 'config/db.php';

$user_id = $_SESSION['user_id'];

$orders = mysqli_query($conn,
"SELECT * FROM orders
WHERE user_id='$user_id'
ORDER BY id DESC");

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<h2>My Orders</h2>

<?php if(isset($_GET['success'])) { ?>

<div class="alert alert-success">

Order Placed Successfully

</div>

<?php } ?>

<table class="table table-bordered">

<thead class="table-success">

<tr>
<th>Order ID</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
<th>Details</th>
</tr>

</thead>

<tbody>

<?php while($order=mysqli_fetch_assoc($orders)){ ?>

<tr>

<td>
#<?php echo $order['id']; ?>
</td>

<td>
₹ <?php echo $order['total_amount']; ?>
</td>

<td>
<?php echo $order['status']; ?>
</td>

<td>
<?php echo $order['created_at']; ?>
</td>

<td>

<a href="order-details.php?id=<?php echo $order['id']; ?>"
class="btn btn-primary btn-sm">

View

</a>

<a href="invoice.php?id=<?php echo $order['id']; ?>"
class="btn btn-success btn-sm">

Invoice

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

=======
<?php

include 'includes/auth.php';
include 'config/db.php';

$user_id = $_SESSION['user_id'];

$orders = mysqli_query($conn,
"SELECT * FROM orders
WHERE user_id='$user_id'
ORDER BY id DESC");

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<h2>My Orders</h2>

<?php if(isset($_GET['success'])) { ?>

<div class="alert alert-success">

Order Placed Successfully

</div>

<?php } ?>

<table class="table table-bordered">

<thead class="table-success">

<tr>
<th>Order ID</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
<th>Details</th>
</tr>

</thead>

<tbody>

<?php while($order=mysqli_fetch_assoc($orders)){ ?>

<tr>

<td>
#<?php echo $order['id']; ?>
</td>

<td>
₹ <?php echo $order['total_amount']; ?>
</td>

<td>
<?php echo $order['status']; ?>
</td>

<td>
<?php echo $order['created_at']; ?>
</td>

<td>

<a href="order-details.php?id=<?php echo $order['id']; ?>"
class="btn btn-primary btn-sm">

View

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

>>>>>>> 01c2f9787f72f05f6df1b4565ac1f76af4d236a3
<?php include 'includes/footer.php'; ?>