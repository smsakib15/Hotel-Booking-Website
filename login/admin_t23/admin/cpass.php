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
$u = $_SESSION['username'];
?>
<?php 
if (isset($_POST['submit'])) {
$password = $_POST['password'];
if (empty($password)) {
  $error = 'Please Enter password !';
}
else{
$sql = "UPDATE admin_login set password = '$password' WHERE username ='$u'";
mysqli_query($con, $sql);
header("location:view_admin.php?username=$u");
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Change Password</title>
<link href="../../images/logo.png" rel="icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/adminlte.min.css">
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
            <h1 class="m-0">Change Password </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="route.php?destination=home">Home</a></li>
              <li class="breadcrumb-item active" style="margin-right:10px;">Change Password </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card-body">

<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><i class="fas fa-cog fa-spin"></i> Change Password</h5>
 
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->

<div class="card-body">
<?php if (isset($error)) {
 echo '<p style= "color:#f56273 ;">'.$error.'</p>';
} ?>
  <form action="cpass.php" method="post">
  <div class="form-group col-md-6">
    <input type="password" name="password" class="form-control" placeholder="Enter new here...">
  </div>
  <input type="submit" class="btn btn-info" name="submit" value="Save Changes">
</form>

</div></div>


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