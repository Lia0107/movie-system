

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


?>
<head>  <style>
body {
background-color: #e2d8d8;
font-family: Arial, sans-serif;

}

/* dropdown list */
.dropdown-body{
    align-items: center;
    justify-content: center;
    background: transparent;
    min-height: 10vh;
    display:flex;
    flex-wrap: wrap;
    min-width: 15em;
    position: relative;
    transition: min-height 0.3s;
    
}
.dropdown{
    min-width: 15em;
    position: relative;
    margin: 2em;
}

.dropdown *{
    box-sizing: border-box;
}
.drop-select{
    background: rgb(255, 230, 4);
    color:#1a1515;
    display:flex;
    justify-content:space-between;
    align-items: center;
    border:2px rgb(32, 31, 30) solid;
    border-radius: 0.5em;
    padding: 1em;
    cursor: pointer;
    transition: background 0.3s;
}

.drop-select-clicked{
    border:2px #26489a solid;
    box-shadow: 0 0 0.8em  #26489a;        
}

.drop-select:hover{
    background:#888888;
}

.caret{
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top:6px solid black;
    transition: 0.3s;
}

.caret-rotate{
    transform:rotate(180deg);
}

.drop-menu{
    list-style:none;
    padding:0.2em 0.5em;
    background: white;
    color:#0f0e0e;
    border:1px #363a43 solid;
    box-shadow: 0 0.5em 1em rgba(0, 0, 0, 0.2);
    border-radius:0.5em;
    position:relative;
    top:0.5em;
    opacity: 0;
    display:none;
    transition:opacity 0.2s;
    z-index:1;
}

.drop-menu li{
    padding: 0.7em 0.5em;
    margin:0.3em 0;
    border-radius:0.5em;
    cursor: pointer;
    opacity: 0.8;
}


.drop-menu li:hover{
    background:#736f6f;
}

/*js*/
.active{
    background:#736f6f;
}
/*js*/
.drop-menu-open{
    display: block;
    opacity:1;
}

/* select showtime */
.container1 {
max-width: 800px;
margin: 0 auto;
padding: 70px;
padding-bottom: 100px;
margin-top: 70px;
height:-750px;
}

.showtime-row {
margin-bottom: 20px;
}

.showtime-header {
display: flex;
align-items: center;
justify-content: space-between;
background-color: #665e5e;
box-shadow: 0 2px 4px rgba(16, 15, 15, 0.1);
padding: 10px 20px;
border-radius: 4px;
}

.expand-btn {
background-color: #e6d6d6;
border: none;
color: #110d0d;
font-size: 14px;
width: 24px;
height: 24px;
line-height: 24px;
text-align: center;
border-radius: 50%;
cursor: pointer;
}

.expand-btn:hover {
background-color: rgb(255, 230, 4);
}

.showtime-content {
display: none;
padding: 10px 0;
}

.showtime-content-active {
display: block;
}

.date-row {
display: flex;
align-items: center;
margin-bottom: 10px;
}

.date-selection {
margin-right: 20px;
cursor: pointer;
}

.date-selection:hover {
text-decoration: underline;
}

.date-select {
font-size: 16px;
padding: 5px;
border-radius: 4px;

}

.time-slots {
display: flex;
flex-wrap: wrap;
margin-top: 10px;
}

.time-slots label:hover {
background-color: #888888;
}

.time-slots label {
display: flex;
align-items: center;
margin-right: 10px;
margin-bottom: 10px;
padding: 6px 12px;
background-color: #ebe0e0;
border: 1px solid #a89191;
border-radius: 4px;
cursor: pointer;
}

.time-slots label input[type="radio"] {
display: none;
}

.time-slots label span {
margin-left: 5px;
}

.time-slots label input[type="radio"]:checked {
background-color: #0f0e0e;
color: #ffffff;
}

    
    
    
    </style>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Moviepoint - Online Movie,Vedio and TV Show HTML Template</title>
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
        <link rel="stylesheet" type="text/css" href="assets/css/movies.css" media="all" />
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
						<form action="showtime.php" method="POST" style="border-color:transparent; margin-left:15px;">
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
        

<?php 
include "../Database/database.php";
$Login = new Login("localhost","user","password","cinema");
$branch = [];
$date = [];
$showtimes = [];
$show = false;

$movieID = empty($_SESSION["movieID"]) ? "" : $_SESSION["movieID"];
$movie = $Login->getMovieDetail($movieID);
$packages = $Login->displayPackage($movieID);
$userID = empty($_SESSION["userID"]) ? "" : $_SESSION["userID"];

if (isset($_POST["searchTime"])) {
    $show = true;
    $branchID = empty($_POST["info"]) ? "" : $_POST["info"];
    $_SESSION["branchID"] = empty($_POST["info"]) ? "" : $_POST["info"];

    $date = $Login->displayShowDate($movieID, $branchID);
}

if(isset($_POST["time"]))
{
    if(!empty($userID))
    {
        $_SESSION["packageID"]=$_POST["packageID"];
        $_SESSION["dateOfmovie"]=$_POST["dateOfmovie"];
        $_SESSION["timeOfmovie"]=$_POST["timeOfmovie"];
        $_SESSION["room"]=$_POST["room"];

        echo "<script>
        alert('Choose the seat that you want');
        window.location.href = '../Seat/hall.php';
        </script>"; //header to the navigation page with the reminder
    }
    else
    {
        echo "<script>
        alert('Please login into your account before purchasing the ticket');
        window.location.href = 'showtime.php';
        </script>"; //header to the navigation page with the reminder
    }

}
$branch = $Login->displayBranch();

?>

<section class="hero-area" id="home">
    <div class="container1">
        <nav>
            <h1 class="main-heading">Select Showtime</h1>
            <h1 class="main-heading" style="font-size:15px;"><?php echo $movie["movieName"];?></h1>

            <div class="dropdown-body">
                <div class="dropdown">
                    <div class="drop-select">
                        <span class="drop-selected">Branch</span>
                        <div class="caret"></div>
                    </div>
                    <ul class="drop-menu">
                        <?php foreach ($branch as $branchItem) { ?>
                            <li>
                                <form action="showtime.php" method="POST">
                                    <input type="hidden" name="info" value="<?php echo $branchItem["branchID"]?>">
                                    <button style="background-color: transparent; border-color: transparent; width:100%;" name="searchTime">
                                        <?php echo $branchItem["branchName"]?>
                                    </button>
                                </form>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>

        <?php if ($show == true) { ?>
            <?php foreach ($date as $dateItem) { ?>
                <div class="showtime-row">
                    <div class="showtime-header">
                        <h2 class="date-heading"><?php echo $dateItem["dateOfmovie"];?></h2>
                        <button class="expand-btn">+</button>
                    </div>
                    <div class="showtime-content">
                        
                        <?php foreach ($packages as $package) { ?>
                            <div class="date-row">
                                <div class="date-selection">
                                    <h3 class="branch-heading"><?php echo $package["packageName"]?></h3>
                                </div>
                                <div class="time-slots">
                                <?php 
                                $showtimes = $Login->displayShowtime($movieID,$package["packageID"],$dateItem["dateOfmovie"],$branchID);
                                foreach($showtimes as $showtime) { ?>

                                    <label>
                                        <form action="showtime.php" method="post">
                                            <input type="hidden" name="room" value="<?php echo $room?>">
                                            <input type="hidden" name="packageID" value="<?php echo $showtime['packageID']; ?>">
                                            <input type="hidden" name="dateOfmovie" value="<?php echo $showtime['dateOfmovie']; ?>">
                                            <input type="hidden" name="timeOfmovie" value="<?php echo $showtime['timeOfmovie']; ?>">
                                            <input type="hidden" name="room" value="<?php echo $showtime['Room']; ?>">

                                            <span><button style="background-color: transparent; border-color: transparent;"name="time"><?php echo $showtime['timeOfmovie']; ?></button></span>
                                        </form>
                                    </label>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</section>
<!-- breadcrumb area end -->

        <!-- footer section start -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <img src="assets/img/logo.png" alt="about" />
                            <p>7th Harley Place, London W1G 8LZ United Kingdom</p>
                            <h6><span>Call us: </span>(+880) 111 222 3456</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4>Legal</h4>
                            <ul>
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Security</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4>Account</h4>
                            <ul>
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">Watchlist</a></li>
                                <li><a href="#">Collections</a></li>
                                <li><a href="#">User Guide</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4>Newsletter</h4>
                            <p>Subscribe to our newsletter system now to get latest news from us.</p>
                            <form action="#">
                                <input type="text" placeholder="Enter your email.."/>
                                <button>SUBSCRIBE NOW</button>
                            </form>
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
        <script>
document.addEventListener("DOMContentLoaded", function() {
const expandButtons = document.querySelectorAll(".expand-btn");

expandButtons.forEach(function(button) {
    button.addEventListener("click", function() {
    const content = this.parentElement.nextElementSibling;
    content.classList.toggle("showtime-content-active");

    const icon = this.innerHTML;
    if (icon === "+") {
        this.innerHTML = "-";
    } else {
        this.innerHTML = "+";
    }
    });
});

const dateSelections = document.querySelectorAll(".date-selection");

dateSelections.forEach(function(selection) {
    selection.addEventListener("click", function() {
    const timeSlots = this.nextElementSibling;
    const checkedRadio = timeSlots.querySelector('input[name="time"]:checked');
    const movieName = this.querySelector("p").textContent;
    if (checkedRadio) {
        const time = checkedRadio.value;
        alert("Movie: " + movieName + "\nTime: " + time);
    } else {
        alert("Please select a time slot");
    }
    });
});
});
//branch js
//loop through all dropdown elements
const dropdowns=document.querySelectorAll('.dropdown-body');
dropdowns.forEach(dropdown =>{
    //get inner elements from each dropdown
    const select = dropdown.querySelector('.drop-select');
    const caret =dropdown.querySelector('.caret');
    const menu = dropdown.querySelector('.drop-menu');
    const options =dropdown.querySelectorAll('.drop-menu li');
    const selected=dropdown.querySelector('.drop-selected');

     //add click event for the select element
select.addEventListener('click',()=>{
    //add clicked select styles to the select element
    select.classList.toggle('drop-select-clicked');
    //add the rotate style to the caret element
    caret.classList.toggle('caret-rotate');
    //add open styles to the menu element
    menu.classList.toggle('drop-menu-open');
});
//loop through all options elements
options.forEach(option=>{
    //add a click event to the option element
    option.addEventListener('click',()=>{
    //change selected inner text to clicked option inner text
    selected.innerText=option.innerText;
    //add the clicked select styles to the select element
    select.classList.remove('drop-select-clicked');
    //add rotate styles to the caret element
    caret.classList.remove('caret-rotate');
    //add open styles to the menu element
    menu.classList.remove('drop-menu-open');
    //remove active class from all option elements
    options.forEach(option=>{
        option.classList.remove('active');
    });
    //add active class to clicked option element
    option.classList.add('active');
    });
});
});
        </script>
    </body>

</html>