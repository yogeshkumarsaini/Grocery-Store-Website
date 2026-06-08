<<<<<<< HEAD
<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "grocery_store";

$conn = mysqli_connect($host,$user,$pass,$db);

if(!$conn)
{
    die("Database Connection Failed : ".mysqli_connect_error());
}
=======
<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "grocery_store";

$conn = mysqli_connect($host,$user,$pass,$db);

if(!$conn)
{
    die("Database Connection Failed : ".mysqli_connect_error());
}
>>>>>>> 01c2f9787f72f05f6df1b4565ac1f76af4d236a3
?>