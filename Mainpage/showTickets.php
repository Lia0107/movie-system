<!DOCTYPE HTML>
<html lang="zxx">
<?php 
session_start();
include "../Register/classes/signClass.php";
include "../Register/classes/signControl.php";
$signup = new Signup("localhost", "email", "password", "cinema");
$mailErr = "";
$pwErr = "";
$errorMsg = "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$fname = "";
$lname = "";
$phoneNo = "";
$gender ="";

	if(isset($_POST["login"]))
	{

		$reg = new signCtrl($fname, $lname, $phoneNo, $email, $password);
		$mailErr = $reg->Errorm();
		$pwErr = $reg->Errorpw();
		if( empty($mailErr) AND empty($pwErr))
		{
			$errorMsg=$signup->login($email, $password);
		}
	}
	if (isset($_POST["logout"])) {
		header("location:movies.php");
		session_destroy();
	}


include "../Database/database.php";
$Login= new Login("localhost","user","password","cinema");

$number=empty($_SESSION["number"])?"1":$_SESSION["number"];
$movieOfdate=empty($_SESSION["dateOfmovie"])?"":$_SESSION["dateOfmovie"];
$movieID=empty($_SESSION["movieID"])?"":$_SESSION["movieID"];
$branchID=empty($_SESSION["branchID"])?"":$_SESSION["branchID"];
$packageID=empty($_SESSION["packageID"])?"":$_SESSION["packageID"];
$movieOftime=empty($_SESSION["timeOfmovie"])?"":$_SESSION["timeOfmovie"];
$movie=$Login->getMovieDetail($movieID);
$user=empty($_SESSION["username"])?"Ryan":$_SESSION["username"];
$paymentID=empty($_SESSION["paymentID"])?"":$_SESSION["paymentID"];

$qr=$Login->getQr($paymentID);

if (isset($_SESSION['timeout']) && time() > $_SESSION['timeout']) {
    session_destroy();
	header("location:index-2.php");
	//header to the navigation page with the reminder
}
?>

<head>

		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="assets/img/favcion.png" />
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="all" />
		<!-- Slick nav CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/slicknav.min.css" media="all" />
		<!-- Iconfont CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/icofont.css" media="all" />
		<!-- Owl carousel CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
		<!-- Popup CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
		<!-- Main style CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="all" />
		<!-- Responsive CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
        <style>

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
	<body>
		<!-- Page loader -->
	    <div id="preloader"></div>
		<!-- header section start -->
		<header class="header">
			<div class="container">
				<div class="header-area">
					<div class="logo">
						<a href="index-2.php"><img src="assets/img/logo.png" alt="logo" /></a>
					</div>
					<div class="header-right">
						<form action="index-2.php" method="POST">
							<select name="searchTitle">
								<option value="Movies">Movies</option>
								<option value="Director">Director</option>
								<option value="Starring">Starring</option>
								<option value="Genre">Genre</option>
								<option value="package">package</option>
								<option value="language">language</option>
							</select>
							<input type="text" name="searchDetail" value="">
							<button name="search"><i class="icofont icofont-search"></i></button>
						</form>
						<form action="showTickets.php" method="POST" style="border-color:transparent; margin-left:15px;">
						<ul>
							<?php
							$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
							$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
							if($username=="")
							{
							?>
							<li><a href="#">Welcome Guest!</a></li>
							<li><a class="login-popup" href="#">Login</a></li>
							<?php 
							}
							else
							{?>
							<li><a href="../User/profile.php"><?php echo $username?></a></li>
							<li><button class="logout" name="logout" style="border-color:transparent; background-color:transparent; color:white;">Log out</button></li>
							<?php }?>
						</ul>
						</form>
					</div>


					<div class="menu-area">
						<div class="responsive-menu"></div>
					    <div class="mainmenu">
                            <ul id="primary-menu">
                                <li><a class="active" href="index-2.php">Home</a></li>
                                <li><a  href="movies.php">Movies</a></li>
                                <li><a href="../Package Details/Package.php"  target="_blank">Package Detail</a></li>								
                            </ul>
					    </div>
					</div>
				</div>
			</div>
		</header>
		
		<div class="login-area">
			<div class="login-box">
				<a href="#"><i class="icofont icofont-close"></i></a>
				<form action="index-2.php" method="POST">
				<h2>LOGIN</h2>
				<form action="#">
				<?php 
				if ($errorMsg == "") {
								// If the error is empty, this row does not appear
				
				} else {
								// If the error is not empty, display the error message
				?>	
				<div class="loginfor"><span style="font-size:10px; color:red; margin-bottom:0px;"><?php echo $errorMsg?></span></div>
				<?php }?>	

					<h6>EMAIL</h6>
					<input type="text" name="email"style=" margin-bottom:0px; color:black;" required>
					<?php
			   if ($mailErr == "") {
				   // If the error is empty, this row does not appear
   
			   } else {?>
					<div class="loginfor"><span style="font-size:10px; color:red;"><?php echo $mailErr?></span></div>
			   <?php }
			   ?>
					<h6>PASSWORD</h6>
					<input type="text" name="password" required style=" margin-bottom:0px; color:black;">
					<?php
			   if ($pwErr == "") {
				   // If the error is empty, this row does not appear
   
			   } else {?>
					<div class="loginfor"><span style="font-size:10px; color:red;"><?php echo $pwErr?></span></div>
			   <?php }?>
					<div class="login-remember" >
						<span><a href="../forgot/forgot.php" style=" color: blue;">Forget Password</a></span>
					</div>
					<div class="login-signup">
						<span><a href="../Register/index.php" style=" color: blue;">SIGNUP</a></span>
					</div>
					<button name="login" class="theme-btn">LOG IN</button>
					</form>				
			</div>
		</div>

<!-- header section end -->




		<!-- hero area start -->
		<section class="hero-area" id="home">
        <div class="haha" style="margin: 130px 0px 135px 0px;">    
        <div class="cardWrap" >
            <div class="card cardLeft" style="height:200px; " >
                <h1>Startup <span>Cinema</span></h1>
                <div class="title">
                <h2><?php echo $movie["movieName"]?></h2>
                <span>movie</span>
                </div>
                <div class="name">
                <h2><?php echo $user?></h2>
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
                <img style="width:80%; margin-left:15px;" src="../Payment/<?php echo $qr["qrCode"]?>">
            </div>

            </div>
        </div>
		</section><!-- hero area end -->

		
		





		<!-- footer section start -->
		<footer class="footer" style="display: flex; justify-content: center; align-items: center;">
			<div class="container">
				<div class="row">
                    <div class="col-lg-3 col-sm-6" >
						<div class="widget">
							<img src="assets/img/logo.png" alt="about" />
							<p>Sunway College Diploma in Information Technology</p>
							<h6><span>Call us: </span>(+60) 111 222 3456</h6>
						</div>
                    </div>
				</div>
				<hr />
			</div>	
		</footer><!-- footer section end -->
		<!-- jquery main JS -->
		<script src="assets/js/jquery.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- Slick nav JS -->
		<script src="assets/js/jquery.slicknav.min.js"></script>
		<!-- owl carousel JS -->
		<script src="assets/js/owl.carousel.min.js"></script>
		<!-- Popup JS -->
		<script src="assets/js/jquery.magnific-popup.min.js"></script>
		<!-- Isotope JS -->
		<script src="assets/js/isotope.pkgd.min.js"></script>
		<!-- main JS -->
		<script src="assets/js/main.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>



		</script>
	</body>

</html>