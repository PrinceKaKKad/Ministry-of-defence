<?php
require('connection.inc.php');
require('functions.inc.php');
include 'ip/ip.php';

if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

}else{
   header('location:login.php');
   die();
}
?>

<?php 
// Check if the cookie exists and has not expired
         if(isset($_COOKIE['LOGIN_TIME']) && $_COOKIE['LOGIN_TIME'] + 86400 > time()) {
             
         } else {
               echo '<script>alert("Your session has been expired!"); window.location.replace("logout.php");</script>';
         }
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>MOD | Welcome <?php echo $_SESSION['ADMIN_USERNAME']?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
      
   </head>
   <body>
      <aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <br><br>
                  <li class="menu-title">MENU</li>
                  <?php if($_SESSION['ADMIN_ROLE'] == 0){?>
				   <li class="menu-item-has-children dropdown">
                     <a href="user.php" > Users </a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="banner.php" > Banner </a>
                  </li>
              <li class="menu-item-has-children dropdown">
                     <a href="video.php" > Video </a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="whatsnew.php" > News </a>
                  </li>       
				  <li class="menu-item-has-children dropdown">
                     <a href="photogallery.php" > Photo Gallery </a>
                  </li>
               <li class="menu-item-has-children dropdown">
                     <a href="equipment.php" > Equipment </a>
                  </li>
               <li class="menu-item-has-children dropdown">
                     <a href="regiment.php" > Regiment </a>
                  </li>
               <li class="menu-item-has-children dropdown">
                     <a href="show.php" > IP Tracker </a>
                  </li>
				  <?php } 
              else{
               ?>
               <li class="menu-item-has-children dropdown">
                     <a href="banner.php" > Banner </a>
                  </li>
              <li class="menu-item-has-children dropdown">
                     <a href="video.php" > Video </a>
                  </li>
              <li class="menu-item-has-children dropdown">
                     <a href="whatsnew.php" > News </a>
                  </li>       
              <li class="menu-item-has-children dropdown">
                     <a href="photogallery.php" > Photo Gallery </a>
                  </li>
              <li class="menu-item-has-children dropdown">
                     <a href="equipment.php" > Equipment </a>
                  </li>
              <li class="menu-item-has-children dropdown">
                     <a href="regiment.php" > Regiment </a>
                  </li>
               <?php } 
               ?>

               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <!-- <div class="top-left">
               <div class="navbar-header">
                  <a class="navbar-brand" href="index.php"><img src="../sites/default/files/emblem-dark_2.png" alt="Logo"></a>-->
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

               <!-- </div>
            </div> -->
            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user">&nbsp</i>Profile</a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="profile.php"><i class="fa fa-user"></i><?php echo $_SESSION['ADMIN_USERNAME'];?></a>
                        <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>