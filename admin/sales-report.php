<?php

include 'auth.php';
include '../config/db.php';

$report = mysqli_query($conn,
"SELECT DATE(created_at) sale_date,
SUM(total_amount) total_sales
FROM orders
GROUP BY DATE(created_at)
ORDER BY sale_date DESC");
?>

<table class="table table-bordered">

<tr>
<th>Date</th>
<th>Sales</th>
</tr>

<?php while($row=mysqli_fetch_assoc($report)){ ?>

<tr>

<td>
<?php echo $row['sale_date']; ?>
</td>

<td>
₹<?php echo $row['total_sales']; ?>
</td>

</tr>

<?php } ?>

</table>