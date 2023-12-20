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
		header("location:index-2.php");
		session_destroy();
	}


include "../Database/database.php";
$Login= new Login("localhost","user","password","cinema");
$movie=[];
$movie=$Login->showMainMovie();

if(isset($_POST["search"]))
{
	if(!empty($_POST["searchDetail"]))
	{
		$_SESSION["searchDetail"]=[];
		if($_POST["searchTitle"]=="Movies")
		{
			$_SESSION["searchDetail"]=$Login->findMovie($_POST["searchDetail"]);
			header("location: searchMovie.php");
		}
		else if($_POST["searchTitle"]=="Director")
		{
			$_SESSION["searchDetail"]=$Login->findDirector($_POST["searchDetail"]);
			header("location: searchMovie.php");
		}
		else if($_POST["searchTitle"]=="Starring")
		{
			$_SESSION["searchDetail"]=$Login->findStarring($_POST["searchDetail"]);
			header("location: searchMovie.php");
		}
		else if($_POST["searchTitle"]=="Genre")
		{
			$_SESSION["searchDetail"]=$Login->findGenre($_POST["searchDetail"]);
			header("location: searchMovie.php");
		}
		else if($_POST["searchTitle"]=="package")
		{
			$_SESSION["searchDetail"]=$Login->findpackage($_POST["searchDetail"]);
			header("location: searchMovie.php");
		}
		else if($_POST["searchTitle"]=="language")
		{
			$_SESSION["searchDetail"]=$Login->findlanguage($_POST["searchDetail"]);
			header("location: searchMovie.php");
		}
	}
	else
	{
		echo "<script>
		alert('Cannot be empty');
		window.location.href = 'index-2.php';
		</script>";  
	}
}
if(isset($_POST["detail"]))
{
	$movieID = empty($_POST["movieID"]) ? "" : $_POST["movieID"];
	$_SESSION["movieID"] = $movieID;
	header("Location: movieDetails.php");
}
if(isset($_POST["ticket"]))
{
	$movieID = empty($_POST["movieID"]) ? "" : $_POST["movieID"];
	$_SESSION["movieID"] = $movieID;
	header("Location: showtime.php");
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
						<form action="index-2.php" method="POST" style="border-color:transparent; margin-left:15px;">
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
				<div class="login-remember" style="float:right">
						<span style="font-size:10px;"><a href="../adminLogin/admin_login.php" style=" color: blue;">Admin Login</a></span>
				</div><br>
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
			<div class="container">
				<div class="hero-area-slider">



				<?php 
				foreach($movie as $movie)
				{
				?>
					<div class="row hero-area-slide">
						<div class="col-lg-6 col-md-5">
							<div class="hero-area-content">
							<img src="../Mainpage/assets/img/Movie/<?php echo $movie["image"]; ?>" alt="about" />
							</div>
						</div>
						<div class="col-lg-6 col-md-7">
							<div class="hero-area-content pr-50">
								<h2><?php echo $movie["movieName"]?></h2>
								<div class="review">
									<div class="author-review">
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
									</div>
									<h4><?php echo rand(1, 200)?>k voters</h4>
								</div>
								<p><?php echo $movie["Synopsis"]?></p>
								<h3>Starring:</h3>
								<div class="slide-cast">
										<?php echo $movie["Starring"]?>
								</div>
								<h3>Running Time:</h3>
								<div class="slide-cast">
										<?php echo $movie["RunningTime"]?>
								</div>

								<div class="slide-trailor">
								<form action="index-2.php" method="POST">
								<input type="hidden" name="movieID" value="<?php echo $movie["movieID"]; ?>">
									<h3>Ticket</h3>
									<button name="ticket" class="theme-btn theme-btn2"><i class="icofont icofont-play"></i> Ticket</button>
								</div>
								<div class="slide-trailor" style="margin-top:8px;">
									<h3>Detail</h3>
										<button name="detail" class="theme-btn theme-btn2"><i class="icofont icofont-play"></i> Detail</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php }?>
				</div>







				<div class="hero-area-thumb">
					<div class="thumb-prev">


					<div class="row hero-area-slide">
						<div class="col-lg-6 col-md-5">
							<div class="hero-area-content">
								<img src="assets/img/Movie/Barbie Movie.jpeg" alt="about" />
							</div>
						</div>
						<div class="col-lg-6 col-md-7">
							<div class="hero-area-content pr-50">
								<h2><?php echo $movie["movieName"]?></h2>
								<div class="review">
									<div class="author-review">
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
									</div>
									<h4><?php echo rand(1, 200)?>k voters</h4>
								</div>
								<p><?php echo $movie["Synopsis"]?></p>
								<h3>Starring:</h3>
								<div class="slide-cast">
										<?php echo $movie['Starring']?>
								</div>
								<h3>Running Time:</h3>
								<div class="slide-cast">
										<?php echo $movie["RunningTime"]?>
								</div>

								<div class="slide-trailor">
									<h3>Ticket</h3>
									<a class="theme-btn theme-btn2" href="../Seat/seat.php"><i class="icofont icofont-play"></i> Ticket</a>
								</div>
								<div class="slide-trailor">
									<h3>Detail</h3>
									<a class="theme-btn theme-btn2" href="../Seat/seat.php"><i class="icofont icofont-play"></i> Detail</a>
								</div>
							</div>
						</div>
					</div>




						
					</div>
					<div class="thumb-next">


					<div class="row hero-area-slide">
						<div class="col-lg-6 col-md-5">
							<div class="hero-area-content">
								<img src="assets/img/Movie/Barbie Movie.jpeg" alt="about" />
							</div>
						</div>
						<div class="col-lg-6 col-md-7">
							<div class="hero-area-content pr-50">
								<h2><?php echo $movie["movieName"]?></h2>
								<div class="review">
									<div class="author-review">
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
									</div>
									<h4><?php echo rand(1, 200)?>k voters</h4>
								</div>
								<p><?php echo $movie["Synopsis"]?></p>
								<h3>Starring:</h3>
								<div class="slide-cast">
										<?php echo $movie["Starring"]?>
								</div>
								<h3>Running Time:</h3>
								<div class="slide-cast">
										<?php echo $movie["RunningTime"]?>
								</div>

								<div class="slide-trailor">
									<h3>Ticket</h3>
									<a class="theme-btn theme-btn2" href="../Seat/seat.php"><i class="icofont icofont-play"></i> Ticket</a>
								</div>
								<div class="slide-trailor">
									<h3>Detail</h3>
									<a class="theme-btn theme-btn2" href="../Seat/seat.php"><i class="icofont icofont-play"></i> Detail</a>
								</div>
							</div>
						</div>
					</div>

					</div>

				</div>
			</div>
		</section><!-- hero area end -->

		
		





		<!-- portfolio section start -->
		<section class="portfolio-area pt-60">
			<div class="container">
				<div class="row flexbox-center">
					<div class="col-lg-6 text-center text-lg-left">
					    <div class="section-title">
							<h1><i class="icofont icofont-movie"></i> Top Movie</h1>
						</div>
					</div>
					<div class="col-lg-6 text-center text-lg-right">
					    <div class="portfolio-menu">
							<ul>
								<li data-filter="*" class="active">Latest</li>
								<li data-filter=".soon">Comming Soon</li>
								<li data-filter=".top">Top Rated</li>
								<li data-filter=".released">Recently Released</li>
							</ul>
						</div>
					</div>
				</div>
				<hr />


				<div class="row">
					<div class="col-lg-9">
						<div class="row portfolio-item">

						<?php 
						$movie=[];

						$movie=$Login->showMainTopMovie();
						foreach($movie as $movie)
						{?>
								<div class="col-md-4 col-sm-6 <?php echo $movie["status"];?>">
								<div class="single-portfolio">
									<div class="single-portfolio-img">
										<img src="../Mainpage/assets/img/Movie/<?php echo $movie["image"]?>" alt="portfolio" />
										<a href="<?php echo $movie["Trailers"]?>" class="popup-youtube">
											<i class="icofont icofont-ui-play"></i>
										</a>
									</div>
									<div class="portfolio-content">
									<form action="index-2.php" method="POST">
										<input type="hidden" name="movieID" value="<?php echo $movie["movieID"]; ?>">
										<h2><button name="detail" style="background-color:transparent; color:white; border-color:transparent;"><?php echo $movie["movieName"]?></button></h2>
									</form>	
										<div class="review">
											<div class="author-review">
												<i class="icofont icofont-star"></i>
												<i class="icofont icofont-star"></i>
												<i class="icofont icofont-star"></i>
												<i class="icofont icofont-star"></i>
												<i class="icofont icofont-star"></i>
											</div>
											<h4><?php echo rand(30,200);?>k voters</h4>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
						?>

						</div>
					</div>
					<div class="col-lg-3 text-center text-lg-left">
					    <div class="portfolio-sidebar">
							<img src="assets/img/Movie/perth.jpg" alt="sidebar" />
							<img src="assets/img/Movie/ryan.jpg" alt="sidebar" />
							<img src="assets/img/Movie/zheqian.jpg" alt="sidebar" />
							<img src="assets/img/Movie/zhiyun.jpg" alt="sidebar" />
						</div>
					</div>

				</div>
			</div>
		</section><!-- portfolio section end -->



		


		<!-- video section start -->
		<section class="video ptb-90">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
					    <div class="section-title pb-20">
							<h1><i class="icofont icofont-film"></i>Trailers & Videos</h1>
						</div>
					</div>
				</div>
				<hr />
				<div class="row">


				<?php 
					$movie1=$Login->showMainTrailer();
					$movie2=$Login->showMainTrailer();
					$movie3=$Login->showMainTrailer();

				?>
                    <div class="col-md-9">
						<div class="video-area">
							<img src="../Mainpage/assets/img/Movie/<?php echo $movie1["image"]?>" alt="video" />
							<a href="<?php echo $movie1["Trailers"];?>" class="popup-youtube">
								<i class="icofont icofont-ui-play"></i>
							</a>
							<div class="video-text">
							<form action="index-2.php" method="POST">
								<input type="hidden" name="movieID" value="<?php echo $movie["movieID"]; ?>">
								<h2><button name="detail" style="background-color:transparent; color:white; border-color:transparent;"><?php echo $movie["movieName"]?></button></h2>
							</form>	
								<div class="review">
									<div class="author-review">
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
										<i class="icofont icofont-star"></i>
									</div>
									<h4><?php echo rand(100,200);?>k voters</h4>
								</div>
							</div>
						</div>
                    </div>


                    <div class="col-md-3">
						<div class="row">
							<div class="col-md-12 col-sm-6">
								<div class="video-area">
									<img src="../Mainpage/assets/img/Movie/<?php echo $movie2["image"]?>" alt="video" />
									<a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
										<i class="icofont icofont-ui-play"></i>
									</a>
								</div>
							</div>
							<div class="col-md-12 col-sm-6">
								<div class="video-area">
									<img src="../Mainpage/assets/img/Movie/<?php echo $movie3["image"]?>" alt="video" />
									<a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
										<i class="icofont icofont-ui-play"></i>
									</a>
								</div>
							</div>
						</div>
                    </div>

				</div>
			</div>
		</section><!-- video section end -->




		<!-- news section start -->
		<section class="news">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
					    <div class="section-title pb-20">
							<h1><i class="icofont icofont-coffee-cup"></i> Latest News</h1>
						</div>
					</div>
				</div>
				<hr />
			</div>


			<div class="news-slide-area">
				<div class="news-slider">
				<?php 
				$movie=[];
				$movie=$Login->showMainLatestMovie();
				foreach($movie as $movie)
				{
					$date = $movie["Date"];
					$month = date("m", strtotime($date));
					$day = date("d", strtotime($date));
					$time = date("Y", strtotime($date));
			?>		
					<div class="single-news">
						<div class="news-bg-1" style="background: url('../Mainpage/assets/img/Movie/<?php echo $movie["image"]?>') no-repeat center / cover;height: 350px;"></div>
						<div class="news-date">
							<h2><span><?php echo $month?></span> <?php echo $day?></h2>
							<h1><?php echo $time?></h1>
						</div>
						<div class="news-content">
						<form action="index-2.php" method="POST">
								<input type="hidden" name="movieID" value="<?php echo $movie["movieID"]; ?>">
								<h2><button name="detail" style="background-color:transparent; color:white; border-color:transparent;"><?php echo $movie["movieName"]?></button></h2>
						</form>	
						</div>
						<a href="#">Read More</a>
					</div>
				<?php 
				}
				?>	


				</div>



				<div class="news-thumb">
					<div class="news-next">
						<div class="single-news">
							<div class="news-bg-3" style="background: url('<?php echo $movie["image"]?>') no-repeat center / cover;height: 350px;" ></div>
							<div class="news-date">
							<h2><span><?php echo $month?></span> <?php echo $day?></h2>
							<h1><?php echo $time?></h1>
							</div>
							<div class="news-content">
							<h2><?php echo $movie["movieName"]?></h2>
							</div>
							<a href="#">Read More</a>
						</div>
					</div>
					<div class="news-prev">
						<div class="single-news">
							<div class="news-bg-2" style="background: url('<?php echo $movie["image"]?>') no-repeat center / cover;height: 350px;" ></div>
							<div class="news-date">
							<h2><span><?php echo $month?></span> <?php echo $day?></h2>
							<h1><?php echo $time?></h1>
							</div>
							<div class="news-content">
							<h2><?php echo $movie["movieName"]?></h2>
							</div>
							<a href="#">Read More</a>
						</div>
					</div>
				</div>

			</div>
		</section><!-- news section end -->




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