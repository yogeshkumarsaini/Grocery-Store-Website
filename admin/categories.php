<?php

include 'auth.php';
include '../config/db.php';

if(isset($_POST['add']))
{
    $category =
    mysqli_real_escape_string(
    $conn,
    $_POST['category_name']
    );

    mysqli_query($conn,
    "INSERT INTO categories(category_name)
     VALUES('$category')");
}

if(isset($_GET['delete']))
{
    $id = (int)$_GET['delete'];

    mysqli_query($conn,
    "DELETE FROM categories WHERE id='$id'");
}

$categories =
mysqli_query($conn,
"SELECT * FROM categories");

include '../includes/header.php';
?>

<div class="container mt-5">

<h2>Categories</h2>

<form method="POST" class="mb-4">

<div class="row">

<div class="col-md-8">

<input
type="text"
name="category_name"
class="form-control"
placeholder="Category Name"
required>

</div>

<div class="col-md-4">

<button
name="add"
class="btn btn-success">

Add Category

</button>

</div>

</div>

</form>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Name</th>
<th>Action</th>
</tr>

<?php while($cat=mysqli_fetch_assoc($categories)){ ?>

<tr>

<td><?php echo $cat['id']; ?></td>

<td><?php echo $cat['category_name']; ?></td>

<td>

<a
href="?delete=<?php echo $cat['id']; ?>"
class="btn btn-danger btn-sm">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<?php include '../includes/footer.php'; ?>