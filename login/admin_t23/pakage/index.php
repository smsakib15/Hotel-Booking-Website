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
$pakage = 'active';
$u = $_SESSION['username'];



if (isset($_POST['submit'])) {
$pakage_name = $_POST['pakage_name'];
$pakage_location = $_POST['pakage_location'];
$cross_price = $_POST['cross_price'];
$price = $_POST['price'];
$pakage_details = $_POST['pakage_details'];

if (empty($pakage_name)) {
$error = 'Please INPUT Pakage name!';
}
else if (empty($pakage_location)) {
$error = 'Please INPUT pakage location!';
}
else if (empty($cross_price)) {
$error = 'Please INPUT cross price!';
}
else if (empty($price)) {
$error = 'Please INPUT price!';
}
else if (empty($pakage_details)) {
$error = 'Please INPUT pakage details!';
}
else if(empty($_FILES["logo_icon"]["name"])) {
$error = 'Please INPUT pakage Icon photo!';
}else{

$filename_pro = $_FILES["logo_icon"]["name"];
$tempname_pro = $_FILES["logo_icon"]["tmp_name"];
$file_basename_pro = substr($filename_pro, 0, strripos($filename_pro, '.')); // get file extention
$file_ext_pro = substr($filename_pro, strripos($filename_pro, '.')); // get file name
if ($file_ext_pro != '.jpg' && $file_ext_pro != '.jpeg' && $file_ext_pro != '.png' && $file_ext_pro != '.PNG') {
$error = 'Please INPUT a supported image formet!';
}else{
$unix_time = time();
$new_pro = $unix_time.$file_ext_pro;
$folder_pro = "../../images/pakage_img/".$new_pro;
move_uploaded_file($tempname_pro, $folder_pro);

mysqli_query($con, "INSERT INTO pakage (name, location, old_price, price, details, status, img, unix_time) VALUES ('$pakage_name', '$pakage_location', '$cross_price', '$price', '$pakage_details', '1', '$new_pro', '$unix_time')");
header("location:../pakage/");
}

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pakage</title>
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
            <h1 class="m-0">Pakages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="route.php?destination=home">Home</a></li>
              <li class="breadcrumb-item active" style="margin-right:10px;">Pakages</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card-body">
<?php if (isset($error)) {
echo '<p align="center" class="text-danger">'.$error.'</p>';
} ?>

<button class="btn btn-info float-right" data-toggle="modal" data-target="#add_offer_modal">ADD Pakage</button>
<br><br>

<div class="modal fade" id="add_offer_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
  <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">ADD Pakage</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
  </div>
<div class="modal-body">
<form method="post" action="" enctype="multipart/form-data">
<div class="form-group">
<label for="pakage_name">Pakage Name:</label>
<input type="text" class="form-control" name="pakage_name" placeholder="Enter Pakage Name..">
</div>
<div class="form-group">
<label for="pakage_location">Location:</label>
<input type="text" class="form-control" name="pakage_location" placeholder="Enter Location..">
</div>
<div class="form-group">
<label for="cross_price">Cross Price:</label>
<input type="number" class="form-control" name="cross_price" placeholder="Enter Cross Price..">
</div>
<div class="form-group">
<label for="price">Price (Per person):</label>
<input type="number" class="form-control" name="price" placeholder="Enter price..">
</div>
<div class="form-group">
<label for="logo_icon">Image:</label>
<input type="file" class="form-control" name="logo_icon">
</div>

<div class="form-group">
<textarea class="form-control" name="pakage_details" placeholder="Enter Pakage Details here..."></textarea>
</div>

</div>
  <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     <button type="submit"  name="submit" class="btn btn-info">Add Now</button>
  </div>
</form>
    </div>
  </div>
</div>


<div style="height: 380px; width: 100%; overflow: scroll;">
<table id="example2" class="table table-bordered table-hover">
<thead style="position: sticky; top: 0; background: #454d55;">
<tr>
<th>ID</th>
<th>Pakage</th>
<th>Action</th>
 </tr>
</thead>
<?php
$result = mysqli_query($con, "SELECT * FROM pakage ORDER BY id DESC ");
while($row = mysqli_fetch_array($result)) { ?>
<tbody>
<tr>
   <td><?php echo $row['id']; ?></td>
   <td><?php echo $row['name'].'<br>Location: '.$row['location'].'<br>Price (per person): '.$row['price'].'tk; <del style="background-color: tomato;">'.$row['old_price'].' tk</del><hr style="border-top: 1px solid white;">'.$row['details']; ?><br>
<img src="<?php echo '../../images/pakage_img/'.$row['img']; ?>" width="80px">
   </td>
 <td>
   
   
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