<?php 
session_start();
if(isset($_SESSION['access_admin_psati_token']))
{
header("location:index.php");
exit;
}
include 'db.php';

if(isset($_POST['submit']))
{
$username = $_POST['username'];
$password = $_POST['password'];
if(empty($_POST['username']))
{
$error = '<span style="color:red;"> Username is Required ! <span>';
}
else if(empty($_POST['password']))
{
$error = '<span style="color:red;"> Password is Required ! <span>';
}
else
  {
$sql = "SELECT * FROM admin_login WHERE username ='$username'";
$stmt = mysqli_query($con, $sql);
if(mysqli_num_rows($stmt) > 0)
{
$row = mysqli_fetch_assoc($stmt);
if($row['password'] == $password)
{
if($row['status'] == 'active')
{
$_SESSION['access_admin_psati_token'] = true;
$_SESSION['user_id'] = $row['user_id'];
$_SESSION['name'] = $row['name'];
$_SESSION['username'] = $row['username'];
$_SESSION['img'] = $row['img'];
if(isset($_SESSION['access_admin_psati_token']))
{
header("location:index.php");
}
 }
else
{
$error =  '<span style="color: red;">Your Account Already Blocked !&#128557;<span';
}
}
else{
  $error = '<span style="color: red;">Invalid Password ! &#128557;<span>';
}
}
else{
  $error = '<span style="color: red;">Invalid Login Candidates ! &#128557;<span>';
}
}
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | Admin Panel</title>
   <link href="../img/logop.png" rel="icon">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/login.js"></script>
</head>
<body><br>
<div class="wrapper">
<div class="login-page">
<div class="form">
  <br>
<form class="login-form" method="post" action="">

<div class="sso-logo">
<img  class="logo" src="../images/logo.png">
<p><b>Admin Login </b></p>
</div>

<?php if(isset($error)){ ?>
<div>
<p><b> &nbsp;<?php  if(isset($error))echo "$error"; ?></b></p> 
</div>
<?php } ?>

<input class="bn-font"  name="username" placeholder="Enter username" autocomplete="off" required="required"/>
<div class="relative">
<input class="bn-font" type="password" name="password" placeholder="Enter Password" autocomplete="off" required="required"/>
 <i class="fa fa-eye show-password"></i>
 </div>             
<button class="bn-font font-16" type="submit" name="submit">LOGIN</button>                                      
</form>
<br><br><br><br><br>
</div>
</div>
<ul class="colorlib-bubbles">
<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
</ul>
</div>
</body>
</html>
