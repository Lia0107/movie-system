<?php

session_start();
include "../User/profileclass/signObject.php";
include "../database/database.php";
include "../object/sendPic.php";
include "../User/profileclass/profileobject.php";

$Login = new Login("localhost", "user", "password", "cinema");

$signup = new Signup("localhost", "email", "password", "cinema");
$image = "facebookanon.jpg"; // Retain the existing image if no file was uploaded
$movieID = isset($_SESSION["movieID"]) ? $_SESSION["movieID"] : "";

$movie=$Login->getMovieDetail($movieID);

// Check if the form is submitted
if (isset($_POST["submit"])) {
   $movieName = isset($_POST["movieName"]) ? $_POST["movieName"] : "";
   $Synopsis = isset($_POST["Synopsis"]) ? $_POST["Synopsis"] : "";
   $Director = isset($_POST["Director"]) ? $_POST["Director"] : "";
   $Starring = isset($_POST["Starring"]) ? $_POST["Starring"] : "";

   $RunningTime = isset($_POST["RunningTime"]) ? $_POST["RunningTime"] : "";
   $Genre = isset($_POST["Genre"]) ? $_POST["Genre"] : "";
   $status = isset($_POST["status"]) ? $_POST["status"] : "";
   $Trailers = isset($_POST["Trailers"]) ? $_POST["Trailers"] : "";

   $Fee = isset($_POST["Fee"]) ? $_POST["Fee"] : "";
   $Date = isset($_POST["Date"]) ? $_POST["Date"] : "";
   $package = isset($_POST["package"]) ? $_POST["package"] : "";
   $language = isset($_POST["language"]) ? $_POST["language"] : "";

      // Check if a file was uploaded
   if($movieName!="" And $Synopsis!="" And $Director!="" And $Starring!="" And $RunningTime!="" And $Genre!="" And $status!="" And $Trailers!="" And $Fee!="" And $Date!="" And $package!="" And $language!="")
   {   
      if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
          $FileUploader = new FileUploader($_FILES);
          $image = $uploadMessage = $FileUploader->uploadMoviePicAdmin();
          // Update the user data in the database
          $errorMsg=$signup->updateMovie($movieID,$movieName, $Synopsis, $Director, $Starring, $RunningTime, $Genre, $image, $status, $Trailers, $Fee, $Date, $package, $language) ;
      } 
      else 
      {
          $image = "cinema-background-with-movie-objects_1823384.jpg"; // Retain the existing image if no file was uploaded
          // Update the user data in the database
          $errorMsg=$signup->updateMovie($movieID,$movieName, $Synopsis, $Director, $Starring, $RunningTime, $Genre, $image, $status, $Trailers, $Fee, $Date, $package, $language) ;

      }
      // Check if there's an error message
   }
   else
   {
      echo "<script>
      alert('Please fill up all of the required fields below');
      window.location.href = 'addMovie.php';
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
                              <h2>Revise Movie</h2>
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
                                    <h2>Revise Movie</h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <form action="admin_movie_details_edit.php" method="post" enctype="multipart/form-data">
                                    <div class="col-lg-12">
                                       <div class="full dis_flex center_text">
                                          <div class="profile_img">
                                             <img width="180" class="rounded-circle" src="../Mainpage/assets/img/Movie/<?php echo $movie["image"]?>" alt="#" /><br>
                                             <!-- File upload button -->
                                                <input type="file" style="margin-top:20px;"  id="fileUpload" name="file" ><br>                                            
                                        </div>
                                        <div class="profile_contant">
                                            <div class="contact_inner">
                                            <label for="movieName">Movie Name</label><br>
                                            <input type="text" name="movieName" value="<?php echo $movie["movieName"];?>"><br>
  
                                            <br><label for="Synopsis">Synopsis</label><br>
                                            <textarea name="Synopsis" rows="4" cols="50" placeholder="Enter the synopsis"><?php echo $movie["Synopsis"]; ?></textarea><br>

                                            <br><label for="Director">Director</label><br>
                                            <input type="text" name="Director" value="<?php echo $movie["Director"];?>"><br>
                                             
                                            <br><label for="Starring">Starring</label><br>
                                            <input type="text" name="Starring" value="<?php echo $movie["Starring"];?>"><br>   
                                              
                                            <br><label for="RunningTime">RunningTime</label><br>
                                            <input type="text" name="RunningTime" value="<?php echo $movie["RunningTime"];?>"><br>     
                                            
                                            <br><label for="Genre">Genre</label><br>                                        
                                            <input type="radio" name="Genre" value="Mystery">
                                            <label for="Mystery">Mystery</label><br>   
                                            <input type="radio" name="Genre" value="Action">
                                            <label for="Action">Action</label><br>    
                                            <input type="radio" name="Genre" value="Comedy">
                                            <label for="Comedy">Comedy</label><br>   
                                            <input type="radio" name="Genre" value="Romance">
                                            <label for="Romance">Romance</label><br> 
                                            <input type="radio" name="Genre" value="Horror">
                                            <label for="Horror">Horror</label><br> 
                                           
                                            <br>Status<br>
                                            <input type="radio" name="status" value="released">
                                            <label for="released">released</label><br>                                           
                                            <input type="radio" name="status" value="soon">
                                            <label for="soon">soon</label><br>
                                            <input type="radio" name="status" value="top">
                                            <label for="top">top</label><br>
                                                                                       
                                            <br><label for="Trailers">Trailers</label><br>
                                            <input type="text" name="Trailers" value="<?php echo $movie["Trailers"];?>"><br>
                                       
                                            <br><label for="Fee">Fee</label><br>
                                            <input type="text" name="Fee" value="<?php echo $movie["Fee"];?>"><br>

                                            <br><label for="Date">Date</label><br>
                                            <input type="date" name="Date" value="<?php echo $movie["Date"];?>"><br>
                                             

                                            <br><label for="package">Package</label><br>
                                            <?php 
                                                $package=$Login->getPackage();
                                                foreach($package as $package)
                                                {
                                            ?>
                                                <input type="radio" name="package" value="<?php echo $package["packageName"]?>">
                                                <label for="top"><?php echo $package["packageName"]?></label><br>
                                            <?php 
                                            }
                                            ?>
                                            <br><label for="language">Language</label><br>
                                            <input type="text" name="language" value="<?php echo $movie["language"];?>"><br>
                                             
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