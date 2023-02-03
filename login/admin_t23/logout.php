<?php
session_start();
unset($_SESSION['access_admin_psati_token']);
session_destroy();
session_unset();
header("location:login.php");
exit;
?>