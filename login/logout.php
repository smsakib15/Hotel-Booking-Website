<?php
session_start();
unset($_SESSION['user_login']);
session_destroy();
session_unset();
header("location:index.php");
exit;
?>