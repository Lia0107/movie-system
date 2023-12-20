<?php

session_start();
include "../User/profileclass/signObject.php";
include "../database/database.php";
include "../object/sendPic.php";
include "../User/profileclass/profileobject.php";

$Login = new Login("localhost", "user", "password", "cinema");
$TimeSlotID = isset($_SESSION["TimeSlotID"]) ? $_SESSION["TimeSlotID"] : "";

// Check if the form is submitted
if (isset($_POST["submit"])) {

    $packageID = !empty($_POST["packageID"]) ? $_POST["packageID"] : "";
    $movieID = !empty($_POST["movieID"]) ? $_POST["movieID"] : "";
    $branchID = !empty($_POST["branchID"]) ? $_POST["branchID"] : "";
    $dateOfmovie = !empty($_POST["dateOfmovie"]) ? $_POST["dateOfmovie"] : "";
    $timeOfmovie = !empty($_POST["timeOfmovie"]) ? $_POST["timeOfmovie"] : "";    
    $room = !empty($_POST["room"]) ? $_POST["room"] : "";    


   if (!empty($packageID) && !empty($movieID) && !empty($branchID) && !empty($dateOfmovie) && !empty($timeOfmovie)) 
   {
    if ($Login->uploadMovieepurchas($movieID, $branchID, $dateOfmovie)) {
    }

      $Login->uploadRoom($room, $dateOfmovie, $timeOfmovie, $branchID,$packageID,$movieID,);
   }
    else
    {
       echo "<script>
       alert('The field cannot be empty');
       window.location.href = 'admin_movieTimeSlot_details_edit.php';
       </script>"; //header to the navigation page with the reminder
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
                              <h2>Time Slot </h2>
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
                                    <h2>Add movie Time Slot</h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <form action="addTimeSlot.php" method="post" >
                                    <div class="col-lg-12">
                                       <div class="full dis_flex center_text">

                                          <div class="profile_contant">
                                             <div class="contact_inner">
                                             <label for="packageName">Package ID</label><br>
                                             <select name="packageID">
                                                <?php 
                                                $package=$Login->displayPackageDetail();
                                                foreach($package as $package)
                                                {
                                                ?>
                                                <option value="<?php echo $package["packageID"]?>"><?php echo $package["packageID"]."-".$package["packageName"]?></option>
                                                <?php 
                                                }?>
                                            </select><br><br>

                                            <label for="movieID">Movie ID</label><br>
                                            <select name="movieID">
                                                <?php 
                                                $movie=$Login->showMainMovie();
                                                foreach($movie as $movie)
                                                {
                                                ?>
                                                <option value="<?php echo $movie["movieID"]?>"><?php echo $movie["movieID"]."-".$movie["movieName"]?></option>
                                                <?php 
                                                }?>
                                            </select><br><br>

                                            <label for="branchID">Branch ID</label><br>
                                            <select name="branchID">
                                                <?php 
                                                $branch=$Login->displayBranch();
                                                foreach($branch as $branch)
                                                {
                                                ?>
                                                <option value="<?php echo $branch["branchID"]?>"><?php echo $branch["branchID"]."-".$branch["branchName"]?></option>
                                                <?php 
                                                }?>
                                            </select><br><br>

                                            <label for="room">Room</label><br>
                                            <select name="room">
                                                <option value="1"><?php echo "Room-1"?></option>
                                                <option value="2"><?php echo "Room-2"?></option>
                                                <option value="3"><?php echo "Room-3"?></option>
                                                <option value="4"><?php echo "Room-4"?></option>
                                                <option value="5"><?php echo "Room-5"?></option>
                                            </select><br><br>

                                            <label for="dateOfmovie">Date of movie</label><br>
                                            <input type="date" id="dateOfmovie" name="dateOfmovie"><br><br>

                                            
                                            <label for="timeOfmovie">Time of movie</label><br>
                                            <input type="time" name="timeOfmovie"><br><br>
                                            
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
      <script>
     // Get the current date
    var currentDate = new Date();

    // Adjust the current date by subtracting one day
    currentDate.setDate(currentDate.getDate() + 1);

    // Format the current date as "YYYY-MM-DD"
    var currentDateString = currentDate.toISOString().split('T')[0];

    // Set the minimum date value for the input field
    document.getElementById('dateOfmovie').min = currentDateString;
</script>
   </body>
</html>