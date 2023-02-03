<?php 
session_start();
if(!isset($_SESSION['access_admin_psati_token']))
{
    unset($_POST);
    unset($_GET);
    header("location:../logout.php");
    exit('');
    die('');
}
else
{
?>
<?php
if(isset($_GET['destination']))
{
$destination = $_GET['destination'];
header("location:../route.php?destination=$destination");
}
else{
  echo '<p align="center" style="color: red; font-size:50px;">404<br>Not Found</p>';
}
?>
<?php } ?>