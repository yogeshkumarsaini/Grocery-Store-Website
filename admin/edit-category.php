<?php

include 'auth.php';
include '../config/db.php';

$id=(int)$_GET['id'];

$category=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM categories WHERE id='$id'")
);

if(isset($_POST['update']))
{
    $name=$_POST['category_name'];

    mysqli_query($conn,
    "UPDATE categories
    SET category_name='$name'
    WHERE id='$id'");

    header("Location: categories.php");
}
?>

<form method="POST">

<input
type="text"
name="category_name"
value="<?php echo $category['category_name']; ?>"
class="form-control">

<br>

<button
name="update"
class="btn btn-success">

Update Category

</button>

</form>