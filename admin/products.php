<?php

include 'auth.php';
include '../config/db.php';

if(isset($_POST['add']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    $name = mysqli_real_escape_string($conn,$_POST['product_name']);
$description = mysqli_real_escape_string($conn,$_POST['description']);

$image = '';

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0)
{
    $image = time().'_'.$_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../assets/images/".$image
    );
}

$result = mysqli_query($conn,
"INSERT INTO products
(
    category_id,
    product_name,
    price,
    stock,
    image,
    description
)
VALUES
(
    '$category_id',
    '$name',
    '$price',
    '$stock',
    '$image',
    '$description'
)");

if(!$result)
{
    die(mysqli_error($conn));
}
}

if(isset($_GET['delete']))
{
    $id=(int)$_GET['delete'];

    mysqli_query($conn,
    "DELETE FROM products WHERE id='$id'");
}

$products = mysqli_query($conn,
"SELECT p.*,c.category_name
 FROM products p
 LEFT JOIN categories c
 ON p.category_id=c.id");

$categories = mysqli_query($conn,
"SELECT * FROM categories");

include '../includes/header.php';
?>

<div class="container mt-5">

<h2>Products</h2>

<form method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-2">

<select
name="category_id"
class="form-control"
required>

<option value="">
Category
</option>

<?php while($cat=mysqli_fetch_assoc($categories)){ ?>

<option value="<?php echo $cat['id']; ?>">
<?php echo $cat['category_name']; ?>
</option>

<?php } ?>

</select>

</div>

<div class="col-md-2">
<input type="text"
name="product_name"
class="form-control"
placeholder="Product Name"
required>
</div>

<div class="col-md-2">
<input type="number"
name="price"
class="form-control"
placeholder="Price"
required>
</div>

<div class="col-md-2">
<input type="number"
name="stock"
class="form-control"
placeholder="Stock"
required>
</div>

<div class="col-md-2">
<input
type="file"
name="image"
class="form-control"
required>
</div>

<div class="col-md-2">
<button
name="add"
class="btn btn-success">

Add Product

</button>
</div>

</div>

<textarea
name="description"
class="form-control mt-2"
placeholder="Description">
</textarea>

</form>

<hr>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Category</th>
<th>Price</th>
<th>Stock</th>
<th>Action</th>
</tr>

<?php while($product=mysqli_fetch_assoc($products)){ ?>

<tr>

<td><?php echo $product['id']; ?></td>

<td>
<img
src="../assets/images/<?php echo $product['image']; ?>"
width="60">
</td>

<td><?php echo $product['product_name']; ?></td>

<td><?php echo $product['category_name']; ?></td>

<td>₹<?php echo $product['price']; ?></td>

<td><?php echo $product['stock']; ?></td>

<td>

<a
href="edit-product.php?id=<?php echo $product['id']; ?>"
class="btn btn-primary btn-sm">

Edit

</a>

<a
href="?delete=<?php echo $product['id']; ?>"
class="btn btn-danger btn-sm">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<?php include '../includes/footer.php'; ?>