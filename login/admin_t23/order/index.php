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
$ptnx = 'active';
$u = $_SESSION['username'];


if (isset($_GET['update_status'],$_GET['ord']) && $_GET['ord'] != null) {
$update_status = $_GET['update_status'];
$update_ord = $_GET['ord'];
$stmt_upord = mysqli_query($con, "SELECT * FROM user_order WHERE id = '$update_ord'");
if (mysqli_num_rows($stmt_upord) == null) {
header("location:index.php");
exit('');
}else{
$row_upord = mysqli_fetch_assoc($stmt_upord);
$upuser_id = $row_upord['user_id'];

$stmt_upord_user = mysqli_query($con, "SELECT * FROM user WHERE user_id = '$upuser_id'");
$row_upu_mo = mysqli_fetch_assoc($stmt_upord_user);
$user_mobile = '88'.$row_upu_mo['mobile'];

mysqli_query($con, "UPDATE user_order set status = '$update_status' WHERE id ='$update_ord'");

if ($update_status == 3) {
$msg = urlencode('Dear user,'.PHP_EOL.'Your order no '.$update_ord.' has been canceled.');
}
else if ($update_status == 5) {
$msg = urlencode('Dear user,'.PHP_EOL.'Your order no '.$update_ord.' has been approved.');
}else{
header("location:index.php");
exit(''); 
}


$apikey = '$2y$10$NENkQMFCLXf635GOdCKjVulgFtJ935EbI4lM.5kmZi3/xRWqqugFe';
$url='http://smsp1.durjoysoft.com/smsapi/non-masking?api_key='.$apikey.'&smsType=text&mobileNo='.$user_mobile.'&smsContent='.$msg.'';
$curl = curl_init();
   curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL =>$url,
    CURLOPT_USERAGENT =>'My Browser'
   ));
 curl_exec($curl);
 curl_close($curl);

header("location:index.php");

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pending Order</title>
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

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}
input[type=number] {
-moz-appearance:textfield;
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
            <h1 class="m-0">Pending Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="route.php?destination=home">Home</a></li>
              <li class="breadcrumb-item active" style="margin-right:10px;">Pending Order</li>
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
<th>Order</th>
<th>Payment</th>
<th>Action</th>
 </tr>
</thead>
<?php
$result = mysqli_query($con, "SELECT * FROM user_order WHERE status = '2' ORDER BY id DESC ");
while($row = mysqli_fetch_array($result)) { 
$pak_id = $row['pakage_to'];
$ouser_id = $row['user_id'];
$order_status = $row['status'];

$sql_find_user = mysqli_query($con, "SELECT * FROM user WHERE user_id = '$ouser_id'");
$row_find_user = mysqli_fetch_array($sql_find_user);

$sql_find_pakage = mysqli_query($con, "SELECT * FROM pakage WHERE id = '$pak_id'");
$row_find_pakage = mysqli_fetch_array($sql_find_pakage);

$amount = $row_find_pakage['price']*$row['guests'];
?>
<tbody>
<tr>
   <td><?php echo $row['id']; ?></td>
   <td><?php echo $row_find_user['name'].'( '.$ouser_id.' )<br>'.$row_find_pakage['name'].'<br>Guests: '.$row['guests']; ?></td>
   <td><?php 
if ($row['payment_method']==1) {
$payment_method = 'bKash';
}
else{
$payment_method = 'Nagad';
}

echo 'Amount: '.$amount.'<br>'.$payment_method.'<br>Account No: '.$row['pay_account'].'<br>TNX No: '.$row['payment_tnx'];
 ?></td>

 <td>
<?php if ($order_status == '1') {
echo '<span class="badge badge-danger">Unpaid</span>';
}else if ($order_status == '3'){
echo '<span class="badge badge-danger">Canceled</span>';
}else if ($order_status == '5'){
echo '<span class="badge badge-success">Approved</span>';
}
else if ($order_status == '2'){ ?>
<a href="index.php?update_status=5&ord=<?php echo $row['id']; ?>"><button class="btnn danger" style="margin-top: 10px;"><i class="fas fa-check-circle"></i></button></a>
<a href="index.php?update_status=3&ord=<?php echo $row['id']; ?>"><button class="btnn success" style="margin-top: 10px;"><i class="fas fa-times-circle"></i></button></a>
<?php } ?>
 </td>

</tr>
<?php } ?>
</tbody>
</table></div>


</div>
  <aside class="control-sidebar control-sidebar-dark"></aside>
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2025 .</strong>
    All rights reserved.
  </footer>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/adminlte.js"></script>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    function check_login(){
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