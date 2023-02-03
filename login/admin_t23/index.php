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
else{
include 'db.php';

$current_file_name = basename($_SERVER['PHP_SELF']);
if ($current_file_name == 'index.php') {
 $light = 'active';
}
?>
<?php 
if(isset($_POST['action']))
{
if($_POST['action'] == 'check_login')
  {
    $user_id = $_SESSION['user_id'];
     $sql = "SELECT * FROM admin_login WHERE user_id = '$user_id'";
     $stmt = mysqli_query($con, $sql);
     $result = mysqli_fetch_assoc($stmt);
     if($result['status'] == 'blocked')
     {
       exit('blocked');
     }
     else
     {
      exit('active');
     }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel | Dashboard</title>
<link href="../images/logo.png" rel="icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">
<style type="text/css">
  input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}
input[type=number] {
-moz-appearance:textfield;
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
  .danger{ background: #02b9ad;color:#fffdfd ; }
  .warnint{ background: #d6a206;color: #ffffff; }
  .success{ background: red;color: #fffdfd; }
</style>
<script src="js/jquery.min.js"></script>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center"> 
<img class="animation__wobble" src="../images/logo.png" width="100px">
  </div>
 <!-- Navbar -->
<?php include 'header.php'; ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
<!------------------------------ Start Home ------------------------------>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" style="margin-right:10px;">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-friends"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><a href="route.php?destination=users" style="color: #fff;">Total Users</a></span>
                <span class="info-box-number"><?php 
$sql_ptnx = "SELECT * FROM user";
$stmt_ptnx = mysqli_query($con, $sql_ptnx);
if (mysqli_num_rows($stmt_ptnx) == null) {
$ptnx = '0';
}else{
$ptnx = mysqli_num_rows($stmt_ptnx);
}
        echo $ptnx; ?></span>
              </div>
            </div>
          </div>
      
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><a href="route.php?destination=ptnx" style="color: #fff;">Pending Order</a></span>
                <span class="info-box-number"><?php 
$sql_ptnx = "SELECT * FROM user_order WHERE status = '2'";
$stmt_ptnx = mysqli_query($con, $sql_ptnx);
if (mysqli_num_rows($stmt_ptnx) == null) {
$ptnx = '0';
}else{
$ptnx = mysqli_num_rows($stmt_ptnx);
}
  echo $ptnx; ?>  </span>
              </div>
            </div>
          </div>


          <div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
              <div class="info-box-content">
      <span class="info-box-text"><a href="#" style="color: #fff;">Total Order</a></span>
                <span class="info-box-number"><?php 
$sql_ptnx = "SELECT * FROM user_order WHERE status != 1";
$stmt_ptnx = mysqli_query($con, $sql_ptnx);
if (mysqli_num_rows($stmt_ptnx) == null) {
$ptnx = '0';
}else{
$ptnx = mysqli_num_rows($stmt_ptnx);
}
        echo $ptnx; ?></span>
              </div>
            </div>
          </div>


<div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-light elevation-1"><i class="fas fa-user-shield"></i></span>
              <div class="info-box-content">
      <span class="info-box-text"><a href="route.php?destination=pakage" style="color: #fff;">Total Pakage</a></span>
                <span class="info-box-number"><?php 
$sql_ptnx = "SELECT * FROM pakage WHERE status='1'";
$stmt_ptnx = mysqli_query($con, $sql_ptnx);
if (mysqli_num_rows($stmt_ptnx) == null) {
$ptnx = '0';
}else{
$ptnx = mysqli_num_rows($stmt_ptnx);
}
        echo $ptnx; ?></span>
              </div>
            </div>
          </div>


  <div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>
              <div class="info-box-content">
      <span class="info-box-text"><a href="#" style="color: #fff;">Total Amount</a></span>
                <span class="info-box-number"><?php 
$stmt_ptnx = mysqli_query($con, "SELECT * FROM user_order WHERE status = '5'");
if (mysqli_num_rows($stmt_ptnx) == null) {
$amount = '0';
}else{
while ($row_a = mysqli_fetch_array($stmt_ptnx)) {
$pak_id = $row_a['pakage_to'];
$sql_find_pakage = mysqli_query($con, "SELECT * FROM pakage WHERE id = '$pak_id'");
$row_find_pakage = mysqli_fetch_array($sql_find_pakage);

$amount += $row_a['guests']*$row_find_pakage['price'];


}
}
  echo $amount; ?></span>
              </div>
            </div>
          </div>



  <div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-light elevation-1"><i class="fas fa-envelope-open-text"></i></span>
              <div class="info-box-content">
      <span class="info-box-text"><a href="route.php?destination=inbox" style="color: #fff;">New Message</a></span>
                <span class="info-box-number"><?php
$stmt_mmmx = mysqli_query($con, "SELECT * FROM inbox WHERE status = '1'");
if (mysqli_num_rows($stmt_mmmx) == null) {
$ptnx = '0';
}else{
$ptnx = mysqli_num_rows($stmt_mmmx);
}
        echo $ptnx; ?></span>
              </div>
            </div>
          </div>


</div>

<!-- <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><i class="fas fa-cog fa-spin"></i> Delete Tutoring subject</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
<div class="card-body">
<form class="form-inline" action="de_tsub/" method="get">
  <div class="form-group mx-sm-2 mb-2">
    <input type="number" class="form-control" name="tuid" placeholder="Enter Tutor ID">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Go</button>
</form>
</div></div> -->



  </div><!--/. container-fluid -->
 </section>
 <!-- /.content -->
</div>


<!------------------------End Home ------------------------------------->
  <!--  home.phpfjhgudrhitreyti8ueytuh -->

  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer"><strong>Copyright &copy; 2020-2025 .</strong> All rights reserved.</footer>
</div>
<!-- ./wrapper -->

<!-- Bootstrap -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.js"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="js/jquery.mousewheel.js"></script>
<!-- ChartJS -->
<script src="js/Chart.min.js"></script>
<script src="js/dashboard2.js"></script>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){

    function check_login()
    {
      $.ajax({
        url:'index.php',
        method:'post',
        data:{action:'check_login'},
        success:function(data)
        {
          if(data.trim() == 'blocked')
          {
            window.location='logout.php';
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