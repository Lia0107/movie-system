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

   
   $title=!empty($_POST["title"])?$_POST["title"]:"";

   $filter=!empty($_POST["filter"])?$_POST["filter"]:"";
   $movieName = isset($_POST["movieName"]) ? $_POST["movieName"] : "";

   if (isset($_POST["ticket"])) 
   {
    $_SESSION["movieName"]=$_POST["movieName"];
    $_SESSION["userName"]=$_POST["userName"];
    $_SESSION["movieOftime"]=$_POST["movieOftime"];
    $_SESSION["qrCode"]=$_POST["qrCode"];
    $_SESSION["paymentID"]=$_POST["paymentID"];

    header("location:ticket.php");
   }



// Set the number of records to be displayed per page
$records_per_page = 10;
$conn=mysqli_connect("localhost", "email", "password", "cinema"); 	
// Get the current page number
if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $_SESSION['current_page1'] = $_GET['page'];
    $page = $_GET['page'];
} else if(isset($_SESSION['current_page1']) && is_numeric($_SESSION['current_page1'])) {
    $page = $_SESSION['current_page1'];
} else {
    $page = 1;
}
// Get the offset value for the SQL query
$offset = ($page - 1) * $records_per_page;


// Query to get the total number of records
$total_query = "SELECT COUNT(*) as total FROM bill where userID='$userID'";
$result_total = mysqli_query($conn, $total_query);
$row_total = mysqli_fetch_assoc($result_total);
$total_records = $row_total['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
                            <i class="fas fa-search" style="color:black;font-size:20px"> Search </i>
                                <form action="checkTicket.php" method="POST">
                                    <select name="filter"> <!--Filter the result-->
                                        <option value="paymentID">paymentID </option>
                                        <option value="movieName">movieName</option>
                                        <option value="movieOfdate">movieOfdate</option>
                                    </select>
                                <input type="text" placeholder="Search" name="title">
                                <button type="submit" class='btn btn-success btn-xs'
                                name="search" style="background-color:#1ed085">Search</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                     <div class="row column1">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">                              
                              </div>
                            <div class="full padding_infor_info">
                                <div class="row">
                                <div class="col-lg-12">
                                <div class="table_row">
                                <div class="full dis_flex center_text">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>paymentID</th>
                                                <th>itemName</th>
                                                <th>itemDetail</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $sql = "SELECT * FROM bill WHERE userID = '$userID' LIMIT $offset, $records_per_page";
                                                if (isset($_POST["search"])) 
                                                {                                                
                                                    // Filter the result based on the search criteria
                                                    if ($filter == "paymentID") 
                                                    {
                                                        // Add appropriate conditions to the query based on the filter and key values
                                                        $sql = "SELECT * FROM bill WHERE paymentID = '$title' AND userID = '$userID' LIMIT $offset, $records_per_page";
                                                            if ($title == "") 
                                                            {
                                                                $sql = "SELECT * FROM bill WHERE userID = '$userID' LIMIT $offset, $records_per_page";
                                                            }
                                                    } 
                                                    else if ($filter == "movieName") 
                                                    {
                                                        $movies = $Login->findMovie($title);
                                                        $movieName = !empty($movies) ? $movies[0]["movieName"] : "evil";

                                                        $sql = "SELECT * FROM bill b, movie m 
                                                        WHERE m.movieID=b.movieID AND
                                                        m.movieName LIKE '%$movieName%' AND userID = '$userID' LIMIT $offset, $records_per_page";
                                                        if ($movieName == "") {
                                                            $sql = "SELECT * FROM bill WHERE userID = '$userID' LIMIT $offset, $records_per_page";
                                                        }
                                                    }
                                                    else if ($filter == "movieOfdate") 
                                                    {
                                                        
                                                        // Add appropriate conditions to the query based on the filter and key values
                                                        $sql = "SELECT * FROM bill WHERE movieOfdate LIKE '%$title%' AND userID = '$userID' LIMIT $offset, $records_per_page";
                                                            if ($title == "") 
                                                            {
                                                                $sql = "SELECT * FROM bill WHERE userID = '$userID' LIMIT $offset, $records_per_page";
                                                            }
                                                    }
                                                } 
                                                else 
                                                {
                                                    // If no search criteria provided, fetch all records for the given user
                                                    $sql = "SELECT * FROM bill WHERE userID = '$userID' LIMIT $offset, $records_per_page";
                                                }
                                                    $result = mysqli_query($Login->conn, $sql);
                                                    $num = mysqli_num_rows($result); // count the number of rows
                                            ?>

                                            <?php
                                            while( $bill = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $bill["paymentID"]?></td>
                                                    <td><?php echo $bill["itemName"]?></td>
                                                    <td><?php echo $bill["itemDetail"]?></td>
                                                    <form action="checkTicket.php" method="post">
                                                    <td>
                                                        <input type="hidden" name="paymentID" value="<?php echo $bill["paymentID"]?>">

                                                        <input type="hidden" name="movieName" value="<?php echo $Login->getMovieDetail($bill["movieID"])["movieName"]?>">

                                                        <input type="hidden" name="userName" value="<?php echo $Login->getUserDetail($bill["userID"])["firstName"]?>">

                                                        <input type="hidden" name="movieOftime" value="<?php echo $bill["movieOftime"]?>">
                                                            
                                                        <input type="hidden" name="qrCode" value="<?php echo $bill["qrCode"]?>">

                                                        <div class="right_button">
                                                        <button class='btn btn-success btn-xs' name="ticket" onclick="showLoginPopup()">Check</button>
                                                        </div>
                                                    </td>
                                                </form>
                                                </tr>
                                                <?php
                                            }
                                            ?>
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

</body>
</html>
