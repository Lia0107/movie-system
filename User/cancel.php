<?php
   session_start();
   include "profileclass/signObject.php";
   include "../database/database.php";
   include "../object/sendPic.php";
   include "profileclass/profileobject.php";


   $Login = new Login("localhost","user","password","cinema");

   $userID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : "";

   $user=$Login->getUserDetail($userID);

   $bill=$Login->getBill($userID);
   $amount=$Login->getUserTotal($userID);

   if(isset($_POST["cancel"]))
   {
      $amount=$_POST["amount"];
      $date=$_POST["movieOfdate"];
      $time=$_POST["movieOftime"];
      $seatNumber=$_POST["itemDetail"];
      $movieName=$_POST["movieName"];


      $email1= new email();
      $email=$Login->getUserDetail($userID)["email"];
      $email1->sendCancellationEmail($email,$movieName, $date, $time, $seatNumber, $amount);
      $Login->deleteBill($_POST["paymentID"]);

      echo "<script>
      alert('deleted successfully!!!');
      window.location.href = 'cancel.php';
      </script>"; //header to the navigation page with the reminder

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
                        <a href="profile.php"><img class="logo_icon img-responsive" src="images/logo/logo.jpg" alt="#" /></a>
                     </div>
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="../Register/picture/<?php echo $user["image"]?>   " alt="#" /></div>
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
               
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Cancellation</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column1">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2><i class="fa fa-file-text-o"></i> cancellation</h2>
                                 </div>
                              </div>
                              <div class="full padding_infor_info">
                                 <div class="table_row">
                                    <div class="table-responsive">
                                       <table class="table table-striped">
                                          <thead>
                                             <tr>
                                                <th>paymentID </th>
                                                <th>itemName</th>
                                                <th>itemDetail</th>
                                                <th>amount</th>
                                                <th>method</th>
                                                <th>movieID </th>
                                                <th>movieOftime</th>
                                                <th>movieOfdate</th>
                                                <th>Button</th>

                                             </tr>
                                          </thead>

                                          <tbody>

                                          <form action="cancel.php" method="post">
                                          <?php
                                          foreach ($bill as $bill) {
                                             // Get the movie date
                                             $movieDate = $bill["movieOfdate"];
                                             
                                             // Check if the movie date has expired
                                             $today = date("Y-m-d");
                                             if ($movieDate >= $today) {
                                                ?>
                                                <tr>
                                                   <td><?php echo $bill["paymentID"]?></td>
                                                   <input type="hidden" name="paymentID" value="<?php echo $bill["paymentID"]?>">
                                                   <td><?php echo $bill["itemName"]?></td>
                                                   <td><?php echo $bill["itemDetail"]?></td>
                                                   <td><?php echo $bill["amount"]?></td>
                                                   <td><?php echo $bill["method"]?></td>
                                                   <td><?php echo $Login->getMovieDetail($bill["movieID"])["movieName"]; ?></td>
                                                   <td><?php echo $bill["movieOftime"]?></td>
                                                   <td><?php echo $bill["movieOfdate"]?></td>

                                                   <input type="hidden" value="<?php $Login->getMovieDetail($bill["movieID"])["movieName"];?>" name="movieName">      
                                                   <input type="hidden" value="<?php echo $bill["itemDetail"]?>" name="itemDetail">      
                                                   <input type="hidden" value="<?php echo $bill["amount"]?>" name="amount">      
                                                   <input type="hidden" value="<?php echo $bill["movieOftime"]?>" name="movieOftime">      
                                                   <input type="hidden" value="<?php echo $bill["movieOfdate"]?>" name="movieOfdate">      

                                                   <?php if ($movieDate != $today) { ?>                                                                                                     
                                                      <td><input type="submit" style="background-color: red;color: white;border: none;padding: 5px 10px;cursor: pointer;"value="Cancel" name="cancel" onclick="return confirm('Are you sure that you want to delete?')"></td>
                                                   <?php } ?>
                                                </tr>
                                                <?php
                                             }
                                          }
                                          ?>
                                       </form>

                                             
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>


                     <!-- row -->
                     <div class="row">
                        <div class="col-md-6">
                           <div class="full white_shd">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Payment Methods</h2>
                                 </div>
                              </div>
                              <div class="full padding_infor_info">
                                 <ul class="payment_option">
                                    <li><img src="images/layout_img/visa.png" alt="#" /></li>
                                    <li><img src="images/layout_img/mastercard.png" alt="#" /></li>
                                    <li><img src="images/layout_img/american-express.png" alt="#" /></li>
                                    <li><img src="images/layout_img/paypal.png" alt="#" /></li>
                                 </ul>
                                 <p class="note_cont">If you use this site regularly and would like to help keep the site on the Internet.</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="full white_shd">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Total Amount</h2>
                                 </div>
                              </div>
                              <div class="full padding_infor_info">
                                 <div class="price_table">
                                    <div class="table-responsive">
                                       <table class="table">
                                          <tbody>
                                             <tr>
                                                   <th style="width:50%">Subtotal:</th>
                                                   <td>$<?php echo number_format($amount,2,".")?></td>
                                             </tr>
                                             <tr>
                                                   <th>Tax (10%)</th>
                                                   <td>$<?php echo number_format($amount * 0.10, 2, "."); ?></td>
                                             </tr>
                                             <tr>
                                                   <th>Total:</th>
                                                   <td>$<?php echo is_numeric($amount) ? number_format($amount * 1.10, 2, ".") : "Invalid amount"; ?></td>
                                               </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
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