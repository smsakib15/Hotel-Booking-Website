<?php 
session_start();
if(!isset($_SESSION['access_admin_psati_token'])){
unset($_POST);
unset($_GET);
header("location:../logout.php");
exit('');
die('');
}else{
include '../db.php';
$users = 'active';
$u = $_SESSION['username'];


if(isset($_GET['update_user_status_blocked'])){
$id = $_GET['update_user_status_blocked'];
$sql = "UPDATE user set status = '0'  WHERE user_id ='$id'";
mysqli_query($con, $sql);
header("location:../user/");
}

else if(isset($_GET['update_user_status_active'])){
$id = $_GET['update_user_status_active'];
$sql = "UPDATE user set status = '1'  WHERE user_id ='$id'";
mysqli_query($con, $sql);
header("location:../user/");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Users</title>
<link href="../../images/logo.png" rel="icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/adminlte.min.css">
  <style type="text/css">
  .btnn{
    border: none;
      padding: 7px 10px;
      border-radius: 4px;
      cursor: pointer;

      outline: none;
      margin-left:5px;
      text-decoration:none;
      text-align:center;
      font-size:small;
      letter-spacing:1px;
  }
  .danger{ background: #02b9ad;color:#fffdfd ;}
  .warnint{background: #d6a206;color: #404040;}
  .success{background: red;color: #fffdfd;}
</style>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center"> 
    <img class="animation__wobble" src="../../images/logo.png" width="100px">
  </div>
 <!-- Navbar -->
<?php include '../header.php'; ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
<!------------------------Start Home ------------------------------------->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="route.php?destination=home">Home</a></li>
              <li class="breadcrumb-item active" style="margin-right:10px;">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 <div class="card-body">

<div style="height: 380px; width: 100%; overflow: scroll;">
<table id="example2" class="table table-bordered table-hover">
<thead style="position: sticky; top: 0; background: #454d55;">
<tr>
<th>ID</th>
<th>Name</th>
<th>E-mail</th>
<th>Action</th>
<th>Date</th>
 </tr>
</thead>
<?php
$result = mysqli_query($con, "SELECT * FROM user ORDER BY user_id DESC ");
while ($row = mysqli_fetch_array($result)) { ?>
<tbody>
<tr>
   <td><?php echo $row["user_id"]; ?></td>
   <td><?php echo $row["name"].'<br>Username: '.$row["username"]; ?></td>
   <td><?php echo $row["email"]; ?></td>
<td>
<?php if ($row["status"] == '1') { ?>
<a href="index.php?update_user_status_blocked=<?php echo $row["user_id"]; ?>"><button class="btnn danger " style="margin-top: 10px;"><i class="fas fa-lock-open"></i></button></a>
<?php } ?>
<?php if ($row["status"] == '0') {  ?>
<a href="index.php?update_user_status_active=<?php echo $row["user_id"]; ?>"><button class="btnn success " style=" margin-top: 10px;"><i class="fas fa-lock"></i></button></a>
<?php } ?>
</td>
<td><?php 
date_default_timezone_set("Asia/Dhaka"); 
echo date("F j, Y, g:i a", $row["unix_time"]); 
?></td>



</tr>
<?php } ?>
</tbody>
</table></div>

</div>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2025 <a href="#">Durjoysoft</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> <span style="margin-right: 10px;">3.0</span>
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.js"></script>
<!-- PAGE PLUGINS -->
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    function check_login()
    {
      $.ajax({
        url:'../index.php',
        method:'post',
        data:{action:'check_login'},
        success:function(data)
        {
          if(data.trim() == 'blocked')
          {
            window.location='../logout.php';
          }
        }
      });
    }
    setInterval(function(){
      check_login();
    }, 1000);
  });
</script>
<?php } ?>