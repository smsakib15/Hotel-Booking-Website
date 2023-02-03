
<?php
include 'admin_t23/db.php';
if (isset($_POST['login'])) {
if (isset($_POST['login_email'],$_POST['login_pass'])) {
$login_email = $_POST['login_email'];
$login_pass = $_POST['login_pass'];

if (empty($login_email)) {
exit('Please Enter Email Address!');
}
else if (empty($login_pass)) {
exit('Please Enter Password!');
}else{
$sql = mysqli_query($con, "SELECT * FROM user WHERE email ='$login_email'");
if(mysqli_num_rows($sql) > 0){
$row = mysqli_fetch_assoc($sql);
if($row['password'] != md5($login_pass)){
exit('Invalid Password!');
}
else if($row['status'] != 1){
exit('Your Account is Blocked !');
}
else{
$_SESSION['user_login'] = true;
$_SESSION['user_id'] = $row['user_id'];
if(isset($_SESSION['user_login'])){
exit('ok');
}

}
}else{
exit('Invalid candidate!');
}
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel agency</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
</head>
<body>
<div class="icons">
        <i class="fas fa-search" id="search-btn"></i>
<?php if (!isset($_SESSION['user_login'])) { ?>
         <i class="fas fa-user" id="login-btn" ></i>
<?php }else{ ?>
<a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
<?php } ?>
    </div>
<form action="index.php" id="login">
 <h3>Login</h3>
  <input type="email" id="login_email" placeholder="enter your email">
  <input type="password" id="login_pass" placeholder="enter your password">
  <button class="btn" id="login_btn">Login Now</button><br>
<!-- <p>forget password? <a href="#">click here</a></p> -->
<p>Don't have and account? <a href="#register" onclick="register()" id="btn">Register now</a></p>
</form>

</body>
</html>