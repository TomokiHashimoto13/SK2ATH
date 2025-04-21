<?php
session_start();
session_unset();  //session value delete
session_destroy(); //session out

header("Location: ./login.php"); // login page
exit();
?>
