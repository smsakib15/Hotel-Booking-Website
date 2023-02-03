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
$admin_list = 'active';
?>
<?php
if(isset($_GET['update_user_status_blocked']))
{
$id = $_GET['update_user_status_blocked'];
$sql = "UPDATE admin_login set status = 'blocked'  WHERE user_id ='$id'";
mysqli_query($con, $sql);
header("location:../admin/");
}

else if(isset($_GET['update_user_status_active']))
{
$id = $_GET['update_user_status_active'];
$sql = "UPDATE admin_login set status = 'active'  WHERE user_id ='$id'";
mysqli_query($con, $sql);
header("location:../admin/");
}
?>
<?php 
if (isset($_GET['username']) && $_GET['username'] != null ) {
$username = $_GET['username'];
$sql_userd = "SELECT * FROM admin_login WHERE username = '$username'";
$stmt_userd = mysqli_query($con, $sql_userd);
$row_userd = mysqli_fetch_assoc($stmt_userd);
$user_id = $row_userd['user_id'];
$name = $row_userd['name'];
$email = $row_userd['email'];
$mobile = $row_userd['mobile'];
$status = $row_userd['status'];
$position = $row_userd['position'];
$password = $row_userd['password'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>View Admin</title>
<link href="../../images/logo.png" rel="icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/adminlte.min.css">
  <style type="text/css">
  .ptext{
  color: #000;
}

.btnn
  {
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

  .modal {
 /*  display: none; /* Hidden by default */
/*  position: fixed; /* Stay in place */
  padding-top: 100px; /* Location of the box */
 left: 0px;
  top: 0px;
right: 0px;
border-radius: 5%;
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  max-width: 600px;
  border: 1px solid #888;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.8s;
  animation-name: animatetop;
  animation-duration: 0.8s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 35px;
  font-weight: bold;
}


.close1 {
  color: white;
  float: right;
  font-size: 35px;
  font-weight: bold;
}


.modal-header {
  padding: 2px 16px;
  background-color: #18a8ad;
  color: white;
}


.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.im{
   border-radius: 50%;
  border: 2px solid #3554b8;
    padding: 2px;
  width:100px
}
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
            <h1 class="m-0">View Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="route.php?destination=home">Home</a></li>
              <li class="breadcrumb-item active" style="margin-right:10px;">View Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card-body">

<!----------------------------------------------------------------------------->
<div class="modal-content">
  <div class="modal-header">
    <p style="font-weight: bold"><?php echo 'Profile <i class="fas fa-arrow-right"></i> '.$name ; ?></p>

    <p align = "right" ><i style="color: #fff; font-size: 25px;" class="fas fa-cog fa-spin"></i></p>
</div>
<div class="modal-body" style="background: #fff; ">
<div  align="center" >
 <div>
  <img src="https://lh3.googleusercontent.com/-LQhgP3SkkXY/YU1-c2syaHI/AAAAAAAAAyM/flUpwZsZMAA3NBBobroncLn4lxKq_PHcwCLcBGAsYHQ/s16000/male.png" class="im">

<b> <p style="font-size: 35px; color:#53cced;"><?php echo $name ; ?><span style="color:#000; font-size:20px"><sub><?php echo ' '.$username ; ?></sub> </span></p></b>

</div>
</div>
<p class="ptext"><span style="font-weight:600">Mobile: &nbsp;</span> <?php echo $mobile ; ?></p>
<p class="ptext"><span style="font-weight:600;">E-mail: &nbsp;</span> <?php echo $email ; ?></p>
<p class="ptext"><span style="font-weight:600;">Position: &nbsp;</span> <?php echo $position ; ?></p>
<?php  if ($position == 'superadmin') { ?>
<p class="ptext"><span style="font-weight:600;">Password: &nbsp;</span> <?php echo $password ; ?></p>
<?php } ?>
<div align="right">
<p> <?php if ($status == 'active') { ?>
            <a href="view_admin.php?update_user_status_blocked=<?php echo $user_id; ?>"><button class="btnn danger " style="margin-top: 10px;"><i class="fas fa-lock-open"></i></button></a> 
          <?php } ?>
<?php if ($status == 'blocked') {  ?>
<a href="view_admin.php?update_user_status_active=<?php echo $user_id; ?>"><button class="btnn success " style=" margin-top: 10px;"><i class="fas fa-lock"></i></button></a>
<?php } ?></p>
</div>
<?php if ($username == $_SESSION['username']) { ?>
<a class="btn btn-warning" href="cpass.php">Change Password</a>
<?php } ?>
  
<br><br>
    </div>
  
  </div>

</div></div></div>
<!----------------------------------------------------------------------------->


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
<?php } else{
  header("location:../admin/");
}
} ?>