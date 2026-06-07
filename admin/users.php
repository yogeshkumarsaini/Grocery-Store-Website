<?php

include 'auth.php';
include '../config/db.php';

$users = mysqli_query($conn,
"SELECT * FROM users");

include '../includes/header.php';
?>

<div class="container mt-5">

<h2>Users</h2>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Created</th>
</tr>

<?php while($user=mysqli_fetch_assoc($users)){ ?>

<tr>

<td><?php echo $user['id']; ?></td>

<td><?php echo $user['name']; ?></td>

<td><?php echo $user['email']; ?></td>

<td><?php echo $user['role']; ?></td>

<td><?php echo $user['created_at']; ?></td>

</tr>

<?php } ?>

</table>

</div>

<?php include '../includes/footer.php'; ?>