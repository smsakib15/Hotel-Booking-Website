<?php
if(!isset($_SESSION['access_admin_psati_token'])){
unset($_POST);
unset($_GET);
header("location:logout.php");
exit('');
die('');
}else{
$b_url = 'https://www.mrdas.xyz/';
?>
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
</li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
<a href="route.php?destination=home" class="brand-link">
 <img src="<?php echo $b_url.'images/logo.png'; ?>" alt="Logo" class="brand-image img-circle elevation-3">
</a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $_SESSION['img']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="route.php?destination=profile" class="d-block"><?php echo $_SESSION['name']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item menu-open">
            <a href="route.php?destination=home" class="nav-link <?php if(isset($light)){ echo $light; } ?>" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
   
<li class="nav-item">
   <a href="route.php?destination=users" class="nav-link <?php if(isset($users)){  echo $users;} ?>">
    <i class="fas fa-users nav-icon"></i><p> Users</p>
   </a>
</li>
  
<li class="nav-item">
 <a href="#" class="nav-link <?php if(isset($ptnx)){ echo $ptnx; } ?> <?php if(isset($stnx)){ echo $stnx; } ?> <?php if(isset($ctnx)){ echo $ctnx; } ?>">
             <i class="fas fa-comments-dollar nav-icon"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
    <a href="route.php?destination=ptnx" class="nav-link <?php if(isset($ptnx)){ echo $ptnx; } ?>">
               <i class="fas fa-spinner nav-icon"></i>
                  <p>Pending Orders</p>
                </a>
              </li>


              <li class="nav-item">
     <a href="route.php?destination=stnx" class="nav-link <?php if(isset($stnx)){ echo $stnx; } ?>">
                 <i class="fas fa-check-circle nav-icon"></i>
                  <p>Successful Orders</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="route.php?destination=ctnx" class="nav-link <?php if(isset($ctnx)){ echo $ctnx; } ?>">
                 <i class="fas fa-times-circle nav-icon"></i>
                  <p>Canceled Orders</p>
                </a>
              </li>

            </ul>
          </li>

<li class="nav-item">
   <a href="route.php?destination=pakage" class="nav-link <?php if(isset($pakage)){  echo $pakage;} ?>">
    <i class="fas fa-tape nav-icon"></i><p> Pakages</p>
   </a>
</li>

<li class="nav-item">
   <a href="route.php?destination=inbox" class="nav-link <?php if(isset($inbox)){  echo $inbox;} ?>">
    <i class="fas fa-envelope-open-text nav-icon"></i><p> Inbox</p>
   </a>
</li>

      
          <li class="nav-item">
            <a href="route.php?destination=logout" class="nav-link">
          <i style="color: red;" class="fas fa-sign-out-alt nav-icon"></i>
              <p>
               Logout
              </p>
            </a>
          
          </li>



</ul>
</li>
</ul>
</nav>
<?php } ?>