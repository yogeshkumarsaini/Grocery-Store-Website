<?php

include 'auth.php';
include '../config/db.php';

if(isset($_POST['update']))
{
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    mysqli_query($conn,
    "UPDATE orders
    SET status='$status'
    WHERE id='$order_id'");
}

$orders = mysqli_query($conn,
"SELECT o.*,u.name
FROM orders o
JOIN users u
ON o.user_id=u.id
ORDER BY o.id DESC");

include '../includes/header.php';
?>

<div class="container mt-5">

<h2>Orders</h2>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Customer</th>
<th>Total</th>
<th>Status</th>
<th>Update</th>
</tr>

<?php while($order=mysqli_fetch_assoc($orders)){ ?>

<tr>

<td>#<?php echo $order['id']; ?></td>

<td><?php echo $order['name']; ?></td>

<td>₹<?php echo $order['total_amount']; ?></td>

<td><?php echo $order['status']; ?></td>

<td>

<form method="POST">

<input
type="hidden"
name="order_id"
value="<?php echo $order['id']; ?>">

<select
name="status"
class="form-control">

<option>Pending</option>
<option>Completed</option>
<option>Cancelled</option>

</select>

<button
name="update"
class="btn btn-success btn-sm mt-1">

Update

</button>

</form>

</td>

</tr>

<?php } ?>

</table>

</div>

<?php include '../includes/footer.php'; ?>