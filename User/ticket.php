<?php
session_start();


   include "profileclass/signObject.php";
   include "../database/database.php";
   include "../object/sendPic.php";
   include "profileclass/profileobject.php";

   $Login = new Login("localhost", "user", "password", "cinema");
   $userID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : "";
   $user = $Login->getUserDetail($userID);
   $amount = $Login->getUserTotal($userID);



   $movieName = isset($_SESSION["movieName"]) ? $_SESSION["movieName"] : "";
   $userName = isset($_SESSION["userName"]) ? $_SESSION["userName"] : "";
   $movieOftime = isset($_SESSION["movieOftime"]) ? $_SESSION["movieOftime"] : "";
   $qrCode = isset($_SESSION["qrCode"]) ? $_SESSION["qrCode"] : "";
   $paymentID = isset($_SESSION["paymentID"]) ? $_SESSION["paymentID"] : "";
   $bill = $Login->getQr($paymentID);

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
    <style>
        /* Login Popup CSS */
        .login-area {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            margin: auto;
            display: none;
            height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 99;
            padding: 0 15px;
        }

        .login-box {
            max-width: 380px;
            background: transparent;
            position: relative;
            color: #03090e;
            margin: 200px auto 0;
            padding: 40px 25px 25px;
        }

        .login-box a {
            color: #03090e;
        }

        .login-box > a {
            position: absolute;
            right: 0;
            top: 0;
            background: #eb315a;
            font-size: 22px;
            color: #fff;
            width: 35px;
            height: 35px;
            text-align: center;
            line-height: 35px;
        }


        .cardWrap {
	 width: 27em;
	 margin: 3em auto;
	 color: #fff;
	 font-family: sans-serif;
}
 .card {
	 background: linear-gradient(to bottom, #e84c3d 0%, #e84c3d 26%, #ecedef 26%, #ecedef 100%);
	 height: 11em;
	 float: left;
	 position: relative;
	 padding: 1em;
	 margin-top: 100px;
}
 .cardLeft {
	 border-top-left-radius: 8px;
	 border-bottom-left-radius: 8px;
	 width: 16em;
}
 .cardRight {
	 width: 6.5em;
	 border-left: 0.18em dashed #fff;
	 border-top-right-radius: 8px;
	 border-bottom-right-radius: 8px;
}
 .cardRight:before, .cardRight:after {
	 content: "";
	 position: absolute;
	 display: block;
	 width: 0.9em;
	 height: 0.9em;
	 background: #fff;
	 border-radius: 50%;
	 left: -0.5em;
}
 .cardRight:before {
	 top: -0.4em;
}
 .cardRight:after {
	 bottom: -0.4em;
}
 h1 {
	 font-size: 1.1em;
	 margin-top: 0;
}
 h1 span {
	 font-weight: normal;
}
 .title, .name, .seat1, .time1 {
	 text-transform: uppercase;
	 font-weight: normal;
}
 .title h2, .name h2, .seat1 h2, .time1 h2 {
	 font-size: 0.9em;
	 color: #525252;
	 margin: 0;
}
 .title span, .name span, .seat1 span, .time1 span {
	 font-size: 0.7em;
	 color: #a2aeae;
}
 .title {
	 margin: 2em 0 0 0;
}
 .name, .seat1 {
	 margin: 0.7em 0 0 0;
}
 .time1 {
	 margin: 0.7em 0 0 1em;
}
 .seat1, .time1 {
	 float: left;
}
 .eye {
	 position: relative;
	 width: 2em;
	 height: 1.5em;
	 background: #fff;
	 margin: 0 auto;
	 border-radius: 1em/0.6em;
	 z-index: 1;
}
 .eye:before, .eye:after {
	 content: "";
	 display: block;
	 position: absolute;
	 border-radius: 50%;
}
 .eye:before {
	 width: 1em;
	 height: 1em;
	 background: #e84c3d;
	 z-index: 2;
	 left: 8px;
	 top: 4px;
}
 .eye:after {
	 width: 0.5em;
	 height: 0.5em;
	 background: #fff;
	 z-index: 3;
	 left: 12px;
	 top: 8px;
}
 .number {
	 text-align: center;
	 text-transform: uppercase;
}
 .number h3 {
	 color: #e84c3d;
	 margin: 0.9em 0 0 0;
	 font-size: 2.5em;
}
 .number span {
	 display: block;
	 color: #a2aeae;
}
 .barcode {
	 height: 2em;
	 width: 0;
	 margin: 1.2em 0 0 0.8em;
	 box-shadow: 1px 0 0 1px #343434, 5px 0 0 1px #343434, 10px 0 0 1px #343434, 11px 0 0 1px #343434, 15px 0 0 1px #343434, 18px 0 0 1px #343434, 22px 0 0 1px #343434, 23px 0 0 1px #343434, 26px 0 0 1px #343434, 30px 0 0 1px #343434, 35px 0 0 1px #343434, 37px 0 0 1px #343434, 41px 0 0 1px #343434, 44px 0 0 1px #343434, 47px 0 0 1px #343434, 51px 0 0 1px #343434, 56px 0 0 1px #343434, 59px 0 0 1px #343434, 64px 0 0 1px #343434, 68px 0 0 1px #343434, 72px 0 0 1px #343434, 74px 0 0 1px #343434, 77px 0 0 1px #343434, 81px 0 0 1px #343434;
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

        <!-- dashboard inner -->
        <div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title">
                            <h2>Invoice</h2>
                        </div>
                    </div>
                </div>
                <!-- row -->                
                    <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2><i class="fa fa-file-text-o"></i> Invoice</h2>
                                </div>
                            </div>
                            <div class="full padding_infor_info">
                                <div class="table_row">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>paymentID</th>
                                                <th>itemName</th>
                                                <th>itemDetail</th>
                                                <th>amount</th>
                                                <th>method</th>
                                                <th>movieID</th>
                                                <th>movieOftime</th>
                                                <th>movieOfdate</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $bill["paymentID"]?></td>
                                                    <td><?php echo $bill["itemName"]?></td>
                                                    <td><?php echo $bill["itemDetail"]?></td>
                                                    <td><?php echo $bill["amount"]?></td>
                                                    <td><?php echo $bill["method"]?></td>
                                                    <td><?php echo $Login->getMovieDetail($bill["movieID"])["movieName"]; ?></td>
                                                    <td><?php echo $bill["movieOftime"]?></td>
                                                    <td><?php echo $bill["movieOfdate"]?></td>
                                                    <td>
                                                    <div class="right_button">
                                                        <button class='btn btn-success btn-xs' onclick="showLoginPopup()">Ticket</button>
                                                    </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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

            

<!-- Login Popup -->
<div class="login-area" id="login-popup">
    <div class="login-box">
        <a href="#" class="close-icon" onclick="hideLoginPopup()">&times;</a>

                    <!-- hero area start -->
                <section class="hero-area" id="home" style="margin:-145px;">
                <div class="cardWrap" >
                    <div class="card cardLeft" style="height:200px; " >
                        <h1>Startup <span>Cinema</span></h1>
                        <div class="title">
                        <h2><?php echo $movieName?></h2>
                        <span>movie</span>
                        </div>
                        <div class="name">
                        <h2><?php echo $userName?></h2>
                        <span>name</span>
                        </div>
                        <div class="seat1">
                        <h2><?php echo $movieOftime?></h2>
                        <span>time</span>
                        </div>
                        
                    </div>
                    <div class="card cardRight" style="width:150px; height:200px;   margin-bottom:150px;">
                        <div class="eye"></div>
                        <div class="number">
                        <span style="margin-top:20px;">seat</span>
                        </div>
                        <img style="width:80%; margin-left:15px;" src="../Payment/<?php echo $qrCode?>">
                    </div>

                </div>
            </div>
            </section><!-- hero area end -->


    </div>
</div>

<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- bootstrap -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- slimscroll -->
<script src="js/jquery.slimscroll.js"></script>
<!-- custom -->
<script src="js/custom.js"></script>
<script>
    function showLoginPopup() {
        document.getElementById("login-popup").style.display = "block";
    }

    function hideLoginPopup() {
        document.getElementById("login-popup").style.display = "none";
        window.location.href = "checkTicket.php";

    }
</script>
</body>
</html>
