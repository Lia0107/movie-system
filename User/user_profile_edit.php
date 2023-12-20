<?php

session_start();
include "profileclass/signObject.php";
include "../database/database.php";
include "../object/sendPic.php";
include "profileclass/profileobject.php";

$Login = new Login("localhost", "user", "password", "cinema");

$userID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : "";

$fnameErr = "";
$lnameErr = "";
$phoneErr = "";
$mailErr = "";
$errorMsg="";
$genderErr="";

$user = $Login->getUserDetail($userID);
$email = !empty($_POST["email"]) ? $_POST["email"] : "";
$emailChan = !empty($_POST["emailChan"]) ? $_POST["emailChan"] : "";
$fname = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
$lname = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
$phoneNo = isset($_POST["phoneNumber"]) ? $_POST["phoneNumber"] : "";
$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
$reg = new profileobject($fname, $lname, $phoneNo, $email, $gender,"");
$name=$fname.$lname;
// Check if the form is submitted
if (isset($_POST["submit"])) {
   $email = isset($_POST["email"]) ? $_POST["email"] : "";
   $fname = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
   $lname = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
   $phoneNo = isset($_POST["phoneNumber"]) ? $_POST["phoneNumber"] : "";
   $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";

   $fnameErr = $reg->Errorfname();
	$lnameErr = $reg->Errorlname();
	$phoneErr = $reg->Errorph();
	$mailErr = $reg->Errorm();
   $genderErr = $reg->Errorgen();
	   
   if (empty($fnameErr) && empty($lnameErr) && empty($phoneErr) && empty($mailErr) && empty($genderErr)) {
      // Check if a file was uploaded
      if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
          $FileUploader = new FileUploader($_FILES);
          $image = $uploadMessage = $FileUploader->uploadMoviePic();
          // Update the user data in the database
          if($emailChan!=$email)
          {
            $email1 = new email();
            $email1->sendUpdatedUserDetailsEmail($email, $name, $email, $phoneNo);
            $errorMsg = $Login->isEmailExists($userID, $fname, $lname, $phoneNo, $gender, $image,$email); 
            
          }
          else
          {
            $email1 = new email();
            $email1->sendUpdatedUserDetailsEmail($email, $name, $email, $phoneNo);
            $Login->updateuserdetails($userID, $fname, $lname, $phoneNo, $gender, $image);
          }
      } else 
      {
          $image = $user["image"]; // Retain the existing image if no file was uploaded
          // Update the user data in the database
          if($emailChan!=$email)
          {
            $email1 = new email();
            $email1->sendUpdatedUserDetailsEmail($email, $name, $email, $phoneNo);
            $errorMsg = $Login->isEmailExists($userID, $fname, $lname, $phoneNo, $gender, $image,$email);


          }
          else
          {
            $email1 = new email();
            $email1->sendUpdatedUserDetailsEmail($email, $name, $email, $phoneNo);
            $Login->updateuserdetails($userID, $fname, $lname, $phoneNo, $gender, $image);
          }


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
   </head>
   <body class="inner_page profile_page">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     <div class="logo_section">
                        <a href="profile.php"><img class="logo_icon img-responsive" src="images/logo/logo.jpg" alt="#" /></a>
                     </div>
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                     <div class="user_img"><img class="img-responsive" src="../Register/picture/<?php echo $user["image"]?>" alt="#" /></div>
                        <div class="user_info">
                           <h6><?php echo $user["firstName"]; ?><?php echo " ";?><?php echo $user["lastName"]; ?></h6>
                           <p><span class="online_animation"></span> Online</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>General</h4>
                  <ul class="list-unstyled components">
                  <li><a href="../Mainpage/index-2.php"><i class="fa fa-home red_color"></i> <span>Home</span></a></li>
                     <li><a href="profile.php"><i class="fa fa-diamond purple_color"></i> <span>My Profile</span></a></li>
                     <li><a href="checkTicket.php"><i class="fa fa-dashboard yellow_color"></i> <span>My Tickets</span></a></li>
                     <li><a href="cancel.php"><i class="fa fa-table purple_color2"></i> <span>Cancellation</span></a></li>
                     <li><a href="contact.php"><i class="fa fa-phone yellow_color"></i><span>Contact Us</span></a></li>
                     <li><a href="../Logout/logout.php"><i class="fa fa-sign-out" style='color:rgb(40, 140, 228)'></i> <span>Log Out</span></a></li>
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
                                 <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="../Register/picture/<?php echo $user["image"]?>" alt="#" /><span class="name_user"><?php echo $user["firstName"]; ?><?php echo " ";?><?php echo $user["lastName"]; ?></span></a>
                                    <div class="dropdown-menu">
                                       <a class="dropdown-item" href="../Mainpage/index-2.php">Home <i class="fa fa-home red_color"></i></a>
                                       <a class="dropdown-item" href="profile.php">My Profile <i class="fa fa-diamond purple_color"></i></a>
                                       <a class="dropdown-item" href="forgot/forgot.php">Change Password <i class="fa fa-lock green_color"></i></a>
                                       <a class="dropdown-item" href="../Logout/logout.php">Log Out <i class="fa fa-sign-out" style='color:rgb(40, 140, 228)'></i></a>
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
                              <h2>Profile</h2>
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
                                    <h2>User Profile</h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <form action="user_profile_edit.php" method="post" enctype="multipart/form-data">
                                    <div class="col-lg-12">
                                       <div class="full dis_flex center_text">
                                          <div class="profile_img">
                                             <img width="180" class="rounded-circle" src="../Register/picture/<?php echo $user["image"]?>" alt="#" /><br>
                                             <!-- File upload button -->
                                                <input type="file" style="margin-top:20px;"  id="fileUpload" name="file" ><br>
                                             
                                          </div>
                                          <div class="profile_contant">
                                             <div class="contact_inner">
                                             <label for="fname">First Name</label><br>
                                             <input type="text" name="firstName" value="<?php echo $user["firstName"]; ?>"><br>
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
                                             <input type="text" name="lastName" value="<?php echo $user["lastName"]; ?>"><br>
                                             <?php
                                             if ($lnameErr == "") {
                                                // If the error is empty, this row does not appear
                                    
                                             } else {
                                                // If the error is not empty, display the error message
                                                ?>
                                                <span style="color:red;"><b><?php echo $lnameErr; ?></b></span><br><br>
                                             <?php } ?>

                                             <br><label for="email">Email</label><br>
                                             <input type="text" name="email" value="<?php echo $user["email"]; ?>"><br>
                                             <input type="hidden" name="emailChan" value="<?php echo $user["email"]; ?>">
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
                                             <input type="text" name="phoneNumber" value="<?php echo $user["phoneNumber"]; ?>"><br>
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
                                             <input type="radio" name="gender" value="male" <?php if ($user["gender"] == "male") echo "checked"; ?>>
                                             <label for="male">Male &nbsp&nbsp</label>
                                             <input type="radio" name="gender" value="female" <?php if ($user["gender"] == "female") echo "checked"; ?>>
                                             <label for="male">Female</label><br>
                                             <?php
                                             if (!empty($genderErr)) {
                                                // If the gender error message is not empty, display the error message
                                                ?>
                                                <span style="color:red;"><b><?php echo $genderErr; ?></b></span><br>
                                             <?php
                                             }
                                             ?>

                                             <div class="right_button">
                                             <br><br><br><button type="submit" class="btn btn-success btn-xs" name="submit" onclick="return confirm('Are you sure that you want to change?')">Save Changes</button>
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