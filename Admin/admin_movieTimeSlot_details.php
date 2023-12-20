<?php
   session_start();
   include "adminclasses/dbcon.php";
   include "../database/database.php";

   $Login = new Login("localhost","user","password","cinema");
  
   $packageID = isset($_SESSION["packageID"]) ? $_SESSION["packageID"] : "";
   $movieID = isset($_SESSION["movieID"]) ? $_SESSION["movieID"] : "";
   $branchID = isset($_SESSION["branchID"]) ? $_SESSION["branchID"] : "";
   $dateOfmovie = isset($_SESSION["dateOfmovie"]) ? $_SESSION["dateOfmovie"] : "";
   $timeOfmovie = isset($_SESSION["timeOfmovie"]) ? $_SESSION["timeOfmovie"] : "";

   if(isset($_POST["edit"]))
   {
      $_SESSION["TimeSlotID"]=$_POST["TimeSlotID"];  
      $_SESSION["packageID"]=$_POST["packageID"];
      $_SESSION["movieID"]=$_POST["movieID"];
      $_SESSION["branchID"]=$_POST["branchID"];
      $_SESSION["dateOfmovie"]=$_POST["dateOfmovie"];
      $_SESSION["timeOfmovie"]=$_POST["timeOfmovie"];
      
      header("location:admin_movieTimeSlot_details_edit.php");
   }
   
   if(isset($_POST["add"]))
   {
      header("location:addTimeSlot.php");
   }

   if(isset($_POST["delete"]))
   {
      $packageID=!empty($_POST["packageID"])?$_POST["packageID"]:"";
      $movieID=!empty($_POST["movieID"])?$_POST["movieID"]:"";
      $branchID=!empty($_POST["branchID"])?$_POST["branchID"]:"";
      $dateOfmovie=!empty($_POST["dateOfmovie"])?$_POST["dateOfmovie"]:"";
      $timeOfmovie=!empty($_POST["timeOfmovie"])?$_POST["timeOfmovie"]:"";
      $Login->deleteTimeSlot($packageID,$movieID,$branchID,$dateOfmovie,$timeOfmovie);
      echo "<script>
      alert('Delete successfully!!!');
      window.location.href = 'admin_movieTimeSlot_details.php';
      </script>"; // Redirect to the desired page after deletion
   }

   $title = !empty($_POST["title"]) ? str_replace(" ", "", $_POST["title"]) : "";
   $filter=!empty($_POST["filter"])?$_POST["filter"]:"";
   
// Set the number of records to be displayed per page
$records_per_page = 10;
$conn=mysqli_connect("localhost", "email", "password", "cinema"); 	
// Get the current page number
if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $_SESSION['current_page7'] = $_GET['page'];
    $page = $_GET['page'];
} else if(isset($_SESSION['current_page7']) && is_numeric($_SESSION['current_page7'])) {
    $page = $_SESSION['current_page7'];
} else {
    $page = 1;
}
// Get the offset value for the SQL query
$offset = ($page - 1) * $records_per_page;


// Query to get the total number of records
$total_query = "SELECT COUNT(*) as total FROM package_movie";
$result_total = mysqli_query($conn, $total_query);
$row_total = mysqli_fetch_assoc($result_total);
$total_records = $row_total['total'];


?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
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
      <!-- custom css -->
      <link rel="stylesheet" href="css/custom.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      
      <style>
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination {
        list-style-type: none;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination li a {
        display: block;
        padding: 5px 10px;
        background-color: #f1f1f1;
        color: #333;
        text-decoration: none;
        border-radius: 3px;
    }

    .pagination li a.active {
        background-color: #333;
        color: #fff;
    }
</style>
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
                              <div class="search">
                                 <i class="fas fa-search" style="color:black;font-size:20px"> Search </i>
                                 <form action="admin_movieTimeSlot_details.php" method="POST">
                                       <select name="filter"> <!--Filter the result-->
                                          <option value="packageID">PackageID </option>
                                          <option value="movieID">MovieID </option>
                                          <option value="branchID">BranchID </option>
                                          <option value="movieName">MovieName </option>
                                          <option value="packageName">PackageName </option>
                                          <option value="branchName">BranchName</option>

                                       </select>
                                       <input type="text" placeholder="Search" name="title">
                                       <button type="submit" name="search" class="search-button">Search</button>
                                       <button class="search-button" style="float: right; margin-right: 15px;" name="add"><a href="addTimeSlot.php" style="color: white;">Add Movie Time Slots</a></button> 
                                    </form>                
                                 </div>
                              </div>
                           </div>
                        </div>
                    
                     <div class="full padding_infor_info">
                        <div class="table_row">
                           <div class="table-responsive">
                              <table class="table table-striped">
                                  <thead>
                                    <tr>
                                       <th>Package ID</th>
                                       <th>Package Name</th>
                                       <th>Movie ID</th>
                                       <th>Movie Name</th>
                                       <th>Branch ID</th>
                                       <th>Branch Name</th>
                                       <th>Date of Movie</th>
                                       <th>Time of Movie</th>
                                       <th>Room</th>
                                       <th>Action</th>
                                    </tr>
                                       </thead>
                                       <tbody>
                                       <?php 
                                                $sql = "SELECT pm.Room,pm.TimeSlotID,b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                where p.packageID=pm.packageID
                                                and b.branchID=pm.branchID
                                                and m.movieID=pm.movieID LIMIT $offset, $records_per_page";
                                                if (isset($_POST["search"])) 
                                                {                                                    
                                                    // Filter the result based on the search criteria
                                                    if ($filter == "packageID") 
                                                    {
                                                        // Add appropriate conditions to the query based on the filter and key values
                                                        $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                        where p.packageID=pm.packageID
                                                        and b.branchID=pm.branchID
                                                        and m.movieID=pm.movieID 
                                                        and p.packageID = '$title' LIMIT $offset, $records_per_page";
                                                            if ($title == "") 
                                                            {
                                                                $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                                where p.packageID=pm.packageID
                                                                and b.branchID=pm.branchID
                                                                and m.movieID=pm.movieID LIMIT $offset, $records_per_page";
                                                            }
                                                    } 

                                                    else if ($filter == "movieName") 
                                                    {
                                                        $movies = $Login->findMovie($title);
                                                        $movieName = !empty($movies) ? $movies[0]["movieName"] : "";
                                                        $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                        where p.packageID=pm.packageID
                                                        and b.branchID=pm.branchID
                                                        and m.movieID=pm.movieID 
                                                        and m.movieName LIKE '%$movieName%' LIMIT $offset, $records_per_page";
                                                        if ($movieName == "") {
                                                            $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                            where p.packageID=pm.packageID
                                                            and b.branchID=pm.branchID
                                                            and m.movieID=pm.movieID 
                                                            LIMIT $offset, $records_per_page";
                                                        }
                                                    }

                                                    else if ($filter == "movieID") 
                                                    {
                                                        // Add appropriate conditions to the query based on the filter and key values
                                                        $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                        where p.packageID=pm.packageID
                                                        and b.branchID=pm.branchID
                                                        and m.movieID=pm.movieID 
                                                        and m.movieID = '$title' LIMIT $offset, $records_per_page";
                                                            if ($title == "") 
                                                            {
                                                                $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                                where p.packageID=pm.packageID
                                                                and b.branchID=pm.branchID
                                                                and m.movieID=pm.movieID LIMIT $offset, $records_per_page";
                                                            }
                                                    }

                                                    else if ($filter == "packageName") 
                                                    {
                                                        $package = $Login->findPackage($title);
                                                        $packageName = !empty($package) ? $package[0]["packageName"] : "";
                                                        $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                        where p.packageID=pm.packageID
                                                        and b.branchID=pm.branchID
                                                        and m.movieID=pm.movieID 
                                                        and p.packageName LIKE '%$packageName%' LIMIT $offset, $records_per_page";
                                                        if ($packageName == "") {
                                                            $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                            where p.packageID=pm.packageID
                                                            and b.branchID=pm.branchID
                                                            and m.movieID=pm.movieID  LIMIT $offset, $records_per_page";
                                                        }
                                                    }
                                                    else if ($filter == "branchName") 
                                                    {
                                                        $branch = $Login->findBranch($title);
                                                        $branchName = !empty($branch) ? $branch[0]["branchName"] : "";
                                                        $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                        where p.packageID=pm.packageID
                                                        and b.branchID=pm.branchID
                                                        and m.movieID=pm.movieID 
                                                        and b.branchName LIKE '%$branchName%' LIMIT $offset, $records_per_page";
                                                        if ($branchName == "") {
                                                            $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                            where p.packageID=pm.packageID
                                                            and b.branchID=pm.branchID
                                                            and m.movieID=pm.movieID  LIMIT $offset, $records_per_page";
                                                        }
                                                    }

                                                    else if ($filter == "branchID") 
                                                    {
                                                        // Add appropriate conditions to the query based on the filter and key values
                                                        $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                        where p.packageID=pm.packageID
                                                        and b.branchID=pm.branchID
                                                        and m.movieID=pm.movieID 
                                                        and b.branchID = '$title' LIMIT $offset, $records_per_page";
                                                            if ($title == "") 
                                                            {
                                                                $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                                where p.packageID=pm.packageID
                                                                and b.branchID=pm.branchID
                                                                and m.movieID=pm.movieID LIMIT $offset, $records_per_page";
                                                            }
                                                    }
                                                } 
                                                else 
                                                {
                                                    // If no search criteria provided, fetch all records for the given user
                                                    $sql = "SELECT pm.Room,pm.TimeSlotID, b.branchName,p.packageName as packageName ,m.movieName,pm.timeOfmovie,pm.dateOfmovie,pm.branchID,pm.movieID,pm.packageID FROM package_movie pm, branch b, package p, movie m
                                                    where p.packageID=pm.packageID
                                                    and b.branchID=pm.branchID
                                                    and m.movieID=pm.movieID LIMIT $offset, $records_per_page";
                                                }
                                                    $result = mysqli_query($Login->conn, $sql);
                                                    $num = mysqli_num_rows($result); // count the number of rows
                                            ?>
                                            
                                       <form action="admin_movieTimeSlot_details.php" method="post">
                                       <?php
                                       while($timeSlotDetail = mysqli_fetch_assoc($result)) {                                           
                                       ?>
                                       <tr>
                                          <form action="admin_movieTimeSlot_details.php" method="post">
                                             <td><?php echo $timeSlotDetail["packageID"]?></td>
                                             <td><?php echo isset($timeSlotDetail["packageName"]) ? $timeSlotDetail["packageName"] : "" ?></td>
                                             <td><?php echo $timeSlotDetail["movieID"]?></td>   
                                             <td><?php echo isset($timeSlotDetail["movieName"]) ? $timeSlotDetail["movieName"] : "" ?></td>
                                             <td><?php echo $timeSlotDetail["branchID"]?></td>
                                             <td><?php echo $timeSlotDetail["branchName"]?></td>
                                             <td><?php echo $timeSlotDetail["dateOfmovie"]?></td>   
                                             <td><?php echo $timeSlotDetail["timeOfmovie"]?></td>   
                                             <td><?php echo $timeSlotDetail["Room"]?></td>   

                                             <input type="hidden" value="<?php echo $timeSlotDetail["packageID"]?>" name="packageID">      
                                             <input type="hidden" value="<?php echo $timeSlotDetail["movieID"]?>" name="movieID">      
                                             <input type="hidden" value="<?php echo $timeSlotDetail["branchID"]?>" name="branchID">      
                                             <input type="hidden" value="<?php echo $timeSlotDetail["dateOfmovie"]?>" name="dateOfmovie">      
                                             <input type="hidden" value="<?php echo $timeSlotDetail["timeOfmovie"]?>" name="timeOfmovie">      
                                             <input type="hidden" value="<?php echo $timeSlotDetail["TimeSlotID"]?>" name="TimeSlotID">      

                                             
                                             <div class="right_button">   
                                             <td>                                                                                                                            
                                             <input type="submit" class="btn btn-success btn-xs" style="background-color: #1ed085; color: white; border: none; padding: 5px 10px; cursor: pointer; width:70px;" value="Edit" name="edit" onclick="return confirm('Are you sure that you want to edit?')">
                                             <br>
                                             <input type="submit" class="btn btn-danger btn-xs" style="background-color: #d9534f; color: white; border: none; padding: 5px 10px; cursor: pointer; width:70px;" value="Delete" name="delete" onclick="return confirm('Are you sure that you want to delete?')">
                                             </td>
                                             </div>         
                                          </form>
                                       </tr>
                                       <?php                                           
                                       }
                                       ?>
                                       </form>                                           
                                       </tbody>
                                 </table>
                                 <div class="pagination-container">
                                            <?php
                                            // Generate pagination links
                                            $pagination = '';
                                            if ($total_records > $records_per_page) {
                                                $total_pages = ceil($total_records / $records_per_page);
                                                $current_page = $page;

                                                $pagination .= '<ul class="pagination">';
                                                if ($current_page > 1) {
                                                    $pagination .= '<li><a href="?page='.($current_page - 1).'">&laquo;</a></li>';
                                                }
                                                for ($i = 1; $i <= $total_pages; $i++) {
                                                    if ($i == $current_page) {
                                                        $pagination .= '<li><a href="?page='.$i.'" class="active">'.$i.'</a></li>';
                                                    } else {
                                                        $pagination .= '<li><a href="?page='.$i.'">'.$i.'</a></li>';
                                                    }
                                                }
                                                if ($current_page < $total_pages) {
                                                    $pagination .= '<li><a href="?page='.($current_page + 1).'">&raquo;</a></li>';
                                                }
                                                $pagination .= '</ul>';

                                                echo $pagination;
                                            }
                                            ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                     <!-- end row -->
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
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
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