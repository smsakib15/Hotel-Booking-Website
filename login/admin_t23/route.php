<?php 
session_start();
if(!isset($_SESSION['access_admin_psati_token']))
{
    unset($_POST);
    unset($_GET);
    header("location:logout.php");
    exit('');
    die('');
}
else
{
  $u = $_SESSION['username'];
?>
<?php
if(isset($_GET['destination']))
{
$destination = $_GET['destination'];
}
//////////////////////////////////////////////////////////////////
if ($destination == 'home') {
header("location:index.php");
}
else if ($destination == 'logout') {
header("location:logout.php");
}
else if ($destination == 'users') {
header("location:user/");
}
else if ($destination == 'admin_list') {
header("location:admin/");
}
else if ($destination == 'add_admin') {
header("location:admin/add_admin.php");
}
else if ($destination == 'profile') {
header("location:admin/view_admin.php?username=$u");
}
else if ($destination == 'pakage') {
header("location:pakage/");
}
else if ($destination == 'ptnx') {
header("location:order/");
}
else if ($destination == 'ptnx') {
header("location:order/");
}
else if ($destination == 'stnx') {
header("location:order/stnx.php");
}
else if ($destination == 'ctnx') {
header("location:order/ctnx.php");
}
else if ($destination == 'inbox') {
header("location:inbox/");
}
else{
  echo '<p align="center" style="color: red; font-size:50px;">404<br>Not Found</p>';
}
///////////////////////////////////////////////////////////////////
?>
<?php } ?>