<?php

session_start();
include "../User/profileclass/signObject.php";
include "../database/database.php";

include "../object/sendPic.php";
include "../User/profileclass/profileobject.php";

$Login = new Login("localhost", "user", "password", "cinema");

$fnameErr = "";
$lnameErr = "";
$phoneErr = "";
$mailErr = "";
$errorMsg="";
$genderErr="";
$pwErr = "";

$email = !empty($_POST["email"]) ? $_POST["email"] : "";
$emailChan = !empty($_POST["emailChan"]) ? $_POST["emailChan"] : "";
$fname = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
$lname = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
$phoneNo = isset($_POST["phoneNumber"]) ? $_POST["phoneNumber"] : "";
$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$signup = new Signup("localhost", "email", "password", "cinema");
$image = "facebookanon.jpg"; // Retain the existing image if no file was uploaded


$reg = new profileobject($fname, $lname, $phoneNo, $email, $gender,$password);

// Check if the form is submitted
if (isset($_POST["submit"])) {
   $email = isset($_POST["email"]) ? $_POST["email"] : "";
   $fname = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
   $lname = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
   $phoneNo = isset($_POST["phoneNumber"]) ? $_POST["phoneNumber"] : "";
   $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
   $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $fnameErr = $reg->Errorfname();
	$lnameErr = $reg->Errorlname();
	$phoneErr = $reg->Errorph();
	$mailErr = $reg->Errorm();
    $genderErr = $reg->Errorgen();
    $pwErr = $reg->Errorpw();

   if (empty($fnameErr) && empty($lnameErr) && empty($phoneErr) && empty($mailErr) && empty($genderErr)&& empty($pwErr)) {
      // Check if a file was uploaded
      if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
          $FileUploader = new FileUploader($_FILES);
          $image = $uploadMessage = $FileUploader->uploadMoviePic();
          // Update the user data in the database
          $errorMsg=$signup->checkUserAdmin($email, $password, $fname, $lname, $phoneNo, $gender,$image);
      } 
      else 
      {
          $image = "facebookanon.jpg"; // Retain the existing image if no file was uploaded
          // Update the user data in the database
          $errorMsg=$signup->checkUserAdmin($email, $password, $fname, $lname, $phoneNo, $gender,$image);

      }
      // Check if there's an error message
  }
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- site icon -->
      <link rel="icon" href="images/fevicon.png" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   </head>
   <body class="inner_page profile_page">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     <div class="logo_section">
                        <a href="user_details.php"><img class="logo_icon img-responsive" src="../User/images/logo/logo.jpg" alt="#" /></a>
                     </div>
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="images/user-account-avatar-icon-pictogram-260nw-1860375778.webp" alt="#" /></div>
                        <div class="user_info">
                           <h6>Admin</h6>
                           <p><span class="online_animation"></span> Online</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>General</h4>
                  <ul class="list-unstyled components">
                     <li><a href="../Mainpage/index-2.php"><i class="fa fa-home red_color"></i> <span>Home</span></a></li>
                     <li><a href="user_details.php"><i class="fa fa-table purple_color2"></i> <span>User Details</span></a></li>
                     <li><a href="admin_statistic_details.php"><i class="fa fa-bar-chart yellow_color"></i> <span>Statistics</span></a></li> 
                     <li><a href="admin_statistic2_details.php"><i class="fa fa-bar-chart yellow_color"></i> <span>Statistics 2</span></a></li>                       <li><a href="admin_movie_details.php"><i class="fa fa-film" style='color:rgb(40, 140, 228)'></i> <span>Movie Details</span></a></li>
                     <li><a href="admin_movieTimeSlot_details.php"><i class="fa fa-clock-o red_color"></i> <span>Movie Time Slots</span></a></li>                     
                     <li><a href="admin_bill_details.php"><i class="fas fa-receipt green_color"></i> <span>Receipts</span></a></li>
                     <li><a href="admin_branch_details.php"><i class="fa fa-map-marker orange_color"></i><span>Branch</span></a> </li>
                     <li><a href="admin_package_details.php"><i class="fa fa-picture-o purple_color"></i> <span>Package</span></a></li>
                     <li><a href="admin_product_details.php"><i class="fa fa-shopping-cart yellow_color"></i> <span>Product</span></a></li>
                     <li><a href="../Logout/logout.php"><i class="fas fa-sign-out-alt" style='color:rgb(40, 140, 228)'></i> <span>Log Out</span></a></li>
                  </ul>
               </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               <div class="topbar">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        <div class="right_topbar">
                           <div class="icon_info">
                              <ul class="user_profile_dd">
                                 <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="images/user-account-avatar-icon-pictogram-260nw-1860375778.webp" alt="#" /><span class="name_user">Admin</span></a>
                                    <div class="dropdown-menu">
                                       <a class="dropdown-item" href="../Logout/logout.php"><span>Log Out</span> <i class="fas fa-sign-out-alt" style='color:rgb(40, 140, 228)'></i></a>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>
               <!-- end topbar -->

               <!-- profile inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Add User</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column1">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Add User</h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <form action="addUser.php" method="post" enctype="multipart/form-data">
                                    <div class="col-lg-12">
                                       <div class="full dis_flex center_text">
                                          <div class="profile_img">
                                             <img width="180" class="rounded-circle" src="../Register/picture/facebookanon.jpg" alt="#" /><br>
                                             <!-- File upload button -->
                                                <input type="file" style="margin-top:20px;"  id="fileUpload" name="file" ><br>
                                             
                                          </div>
                                          <div class="profile_contant">
                                             <div class="contact_inner">
                                             <label for="fname">First Name</label><br>
                                             <input type="text" name="firstName" ><br>
                                             <?php                                              
                                             if ($fnameErr == "") {
                                                // If the error is empty, this row does not appear
                                    
                                             } else {
                                                // If the error is not empty, display the error message
                                                ?>
                                                <span style="color:red;"><b><?php echo $fnameErr; ?></b></span><br>
                                             <?php }
                                                ?>

                                             <br><label for="lname">Last Name</label><br>
                                             <input type="text" name="lastName"><br>
                                             <?php
                                             if ($lnameErr == "") {
                                                // If the error is empty, this row does not appear
                                    
                                             } else {
                                                // If the error is not empty, display the error message
                                                ?>
                                                <span style="color:red;"><b><?php echo $lnameErr; ?></b></span><br><br>
                                             <?php } ?>

                                             <br><label for="email">Email</label><br>
                                             <input type="text" name="email" ><br>
                                             <input type="hidden" name="emailChan" >
                                             <?php
                                             if ($mailErr == "") {
                                                // If the error is empty, this row does not appear

                                             } else {
                                                // If the error is not empty, display the error message
                                                ?>
                                                <span style="color:red;"><b><?php echo $mailErr; ?></b></span><br>
                                             <?php
                                             }
                                             ?>
                                             <?php
                                             if ($errorMsg == "") {
                                                // If the error is empty, this row does not appear

                                             } else {
                                                // If the error is not empty, display the error message
                                                ?>
                                                <span style="color:red;"><b><?php echo $errorMsg; ?></b></span><br>
                                             <?php
                                             }
                                             ?>

                                             <br><label for="phone">Phone Number</label><br>
                                             <input type="text" name="phoneNumber" ><br>
                                             <?php
                                             if ($phoneErr == "") {
                                                // If the error is empty, this row does not appear
                                    
                                             } else {
                                                // If the error is not empty, display the error message
                                                ?>
                                                <span style="color:red;"><b><?php echo $phoneErr; ?></b></span><br>
                                             <?php
                                             }
                                             ?>

                                             <br>Gender<br>
                                             <input type="radio" name="gender" value="Male">
                                             <label for="male">Male &nbsp&nbsp</label>
                                             <input type="radio" name="gender" value="Female">
                                             <label for="male">Female</label><br>
                                             <?php
                                             if (!empty($genderErr)) {
                                                // If the gender error message is not empty, display the error message
                                                ?>
                                                <span style="color:red;"><b><?php echo $genderErr; ?></b></span><br>
                                             <?php
                                             }
                                             ?>
                                             <br><label for="password">Password</label><br>
                                             <input type="Password" name="password"><br>
                                             <?php
                                             if ($pwErr == "") {
                                                // If the error is empty, this row does not appear
                                    
                                             } else {
                                                // If the error is not empty, display the error message
                                                ?>
                                                <span style="color:red;"><b><?php echo $pwErr; ?></b></span><br><br>
                                             <?php } ?>
                                             <div class="right_button">
                                             <br><br><br><button type="submit" class="btn btn-success btn-xs" name="submit" onclick="return confirm('Are you sure that you want to change?')">Add</button>
                                             </div>
                                             </form>
                                             </div>
                                          </div>
                                       </div>                                    
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-2"></div>
                        </div>
                        <!-- end row -->
                     </div>
                     <!-- footer -->
                     <div class="container-fluid">
                        <div class="footer">
                           <p>Copyright © 2023. All rights reserved.<br><br>
                           </p>
                        </div>
                     </div>
                  </div>
                  <!-- end dashboard inner -->
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>