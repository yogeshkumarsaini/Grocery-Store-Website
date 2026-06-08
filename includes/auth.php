<<<<<<< HEAD
<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}
=======
<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}
>>>>>>> 01c2f9787f72f05f6df1b4565ac1f76af4d236a3
?>