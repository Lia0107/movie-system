<!DOCTYPE html>
<?php
session_start();
include "../Database/database.php";

$Login= new Login("localhost","user","password","cinema");

$finalPrice = empty($_SESSION["price"]) ? "" : $_SESSION["price"]; //tickets
$popcornPrice = empty($_SESSION["popcornPrice"]) ? "" : $_SESSION["popcornPrice"]; //tickets
$number = empty($_SESSION["number"]) ? "" : $_SESSION["number"];
$seatNumber = empty($_SESSION["seatNumber"]) ? "" : $_SESSION["seatNumber"];
$itemName = empty($_SESSION["itemName"]) ? "" : $_SESSION["itemName"];
$paymentID = empty($_SESSION["paymentID"]) ? "" : $_SESSION["paymentID"];

$userID = empty($_SESSION["userID"]) ? "" : $_SESSION["userID"];
$room=empty($_SESSION["room"])?"":$_SESSION["room"];


$number=empty($_SESSION["number"])?"1":$_SESSION["number"];
$movieOfdate=empty($_SESSION["dateOfmovie"])?"":$_SESSION["dateOfmovie"];
$movieID=empty($_SESSION["movieID"])?"":$_SESSION["movieID"];
$branchID=empty($_SESSION["branchID"])?"":$_SESSION["branchID"];
$packageID=empty($_SESSION["packageID"])?"":$_SESSION["packageID"];
$movieOftime=empty($_SESSION["timeOfmovie"])?"":$_SESSION["timeOfmovie"];

$seatNumber = trim($seatNumber);
$movieOfdate = trim($movieOfdate);
$movieOftime = str_replace(":", "", $movieOftime);
$seatNumber = str_replace("Array", "", $seatNumber);

if (isset($_SESSION['timeout1']) && time() > $_SESSION['timeout1']) {
    session_destroy();
	header("location:../Mainpage/index-2.php");
	//header to the navigation page with the reminder
}


if($popcornPrice=="")
{
    $price="$finalPrice";
}
else
{
    $price="$finalPrice"+"$popcornPrice";
}

$movie=$Login->getMovieDetail($movieID);
$branch=$Login->getBranch($branchID);
$package=$Login->getPackageDetail($packageID);

if($itemName!="Tickets with Popcorn")
{
    $itemName="Seat";
}
else
{
    $itemName="Popcorn\nSeat";
}
if (isset($_POST["submit"])) 
{
    if( $_POST["payment"]=="online")
    {
        $method="online";
    }
    else if( $_POST["payment"]=="cash")
    {
        $method="cash";
    }

    if( is_numeric($_POST["Cmonth"]) and  is_numeric($_POST["Cyear"]))
    {
        // Include the qrlib file
        include '../Mainpage/phpqrcode/qrlib.php';
        $_SESSION['timeout'] = time() + 10;

        // $text variable has data for QR
        $text = "SeatNumber is: $seatNumber . \nDate Of movie is: $movieOfdate . \nTime of movie is: $movieOftime . \nMovie Name is: " . $movie['movieName'] . " . \nBranch is : " . $branch['branchName'] . " . \nPackage is: " . $package['packageName']
        . " . \nHall Number is: " . $room;

        // Set the file path
        $filepath = "qrcodes/" . $seatNumber . $movieOfdate . $movieOftime . $movieID . $branchID . $packageID . $room . ".png";

        // Generate and save the QR code
        QRcode::png($text, $filepath);
        $Login->uploadQr($itemName,$seatNumber,$price,$method,$userID,$filepath,$movieID,$movieOftime,$movieOfdate);
        $email = new email();
        $email2=$Login->getUserDetail($userID)["email"];
        $email->sendBill($email2, $movieOfdate, $movieOftime, $price, $seatNumber,$movie['movieName']);

        echo "<script>
        alert('Payment successful!!!');
        window.location.href = '../Mainpage/showTickets.php';
        </script>"; //header to the navigation page with the reminder
    }
    else
    {
        echo "<script>
        alert('The required field cannot be empty!!');
        window.location.href = 't.php';
        </script>"; //header to the navigation page with the reminder
    }
}

?>
<html lang="en">
<head>
	<meta charset="UTF-8" />
    <title>Payment</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width,
			initial-scale=1.0" />
	<link rel="stylesheet" href="style.css" class="css" />
</head>

<body>
	<div class="container">
        <div class="price">
            <h1>Your Total Is RM <?php 
            if(!empty($finalPrice))
            {
                echo $popcornPrice;
            }
            if(empty($popcornPrice))
            {
                echo $finalPrice;
            }
            
            ?></h1>
        </div>
        <form action="t.php" method="POST">
        <div class="card__container">
            <div class="card">
                <div class="row TNG">
                    <div class="left">
                        <input id="pp" type="radio" name="payment" value="cash"/>
                        <div class="radio"></div>
                        <label for="pp">Cash at counter</label>
                    </div>
                    <div class="right">
                        <img src="TNG.jpg" alt="TNG" />
                    </div>
                </div>
                <div class="row credit">
                    <div class="left">
                        <input id="cd" type="radio" name="payment" value="online"/>   
                        <div class="radio"></div>
                        <label for="cd">Debit / Credit Card/Touch 'n Go</label>
                    </div>
                    <div class="right">
                        <img src="Visa.jpg" alt="visa" />
                        <img src="Mastercard.jpg" alt="mastercard" />
                        <img src="TNG.jpg" alt="TNG" />

                    </div>
                </div>
                <div class="row cardholder">
                    <div class="info">
                        <label for="cardholdername">Name</label>
                        <input placeholder="e.g. Cristiano Ronaldo" id="cardholdername" type="text" required/>
                    </div>
                </div>
                <div class="row number">
                    <div class="info">
                        <label for="cardnumber">Card number</label>
                        <input id="cardnumber" type="text" pattern="[0-9]{16,19}" maxlength="19" placeholder="8888-8888-8888-8888" required/>
                    </div>
                </div>
                <div class="row details">
                    <div class="left">
                        <label for="expiry-date">Expiry</label>
                        <select id="expiry-date" name="Cmonth">
                            <option>MM</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <span>/</span>
                         <select id="expiry-date" name="Cyear">
                            <option>YYYY</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                    </div>
                    <div class="right">
                        <label for="cvv">CVC/CVV</label>
                        <input type="text" maxlength="3" placeholder="123" required/>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="button">
            <button type="submit" name="submit">Confirm and Pay</button>
        </div>
    </div>
</form>
</body>
</html>
