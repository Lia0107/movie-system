<!DOCTYPE html>
<?php
session_start();
$movieOfdate=empty($_SESSION["dateOfmovie"])?"":$_SESSION["dateOfmovie"];
$movieID=empty($_SESSION["movieID"])?"":$_SESSION["movieID"];
$branchID=empty($_SESSION["branchID"])?"":$_SESSION["branchID"];
$packageID=empty($_SESSION["packageID"])?"":$_SESSION["packageID"];
$movieOftime=empty($_SESSION["timeOfmovie"])?"":$_SESSION["timeOfmovie"];
$userID=empty($_SESSION["userID"])?"":$_SESSION["userID"];
include "../Database/database.php";
$login = new Login("localhost", "user", "password", "cinema"); //connect to the object oriented of SQL for connecting the database
$occupied=$login->isOccupied($movieOfdate, $movieID ,$branchID,$packageID,$movieOftime);//for getting the data and movie number***
$movie=$login->getMovieDetail($movieID);
$package = $login->getPackageDetail($packageID);
$room=empty($_SESSION["room"])?"":$_SESSION["room"];


if(isset($_POST["submit"]))
{
  $_SESSION["number"]=0;
  if(!empty($_POST['seats']))
  {
    $selectedSeats = $_POST['seats'];
    $seatNumber=[];
    foreach($selectedSeats as $seat) 
    {
      $seatNumber.=$seat." ";
      $_SESSION["number"]+=1;
      $login->uploadTicket($movieOfdate, $movieID , $seat, $branchID,$packageID,$movieOftime,$userID,$room);
    }
    $_SESSION["seatNumber"]=$seatNumber;

    header("location: ../Mainpage/select.php");
    //header to the navigation page with the reminder
  }
  else
  {
    echo "<script>
    alert('The seat cannot be empty');
    window.location.href = 'seat.php';
    </script>"; //header to the navigation page with the reminder
  }
}
if(isset($_POST["cancel"]))
{    echo "<script>
  alert('Go back to the Home page');
  window.location.href = '../Mainpage/index-2.php';
  </script>";

}
$seatOccupied="no";

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="filmname"><?php echo $movie["movieName"]?></div>
    <div class="filmDetail"><?php echo $movie["language"]?> | <?php echo $movie["RunningTime"]?> | <?php echo $package["packageName"]?></div>
    <div class="filmDetail1">Sunway Univercity</div>
    <div class="filmDetail2">Hall-01<br><?php ?></div><!--This is for time-->

    <div class="icon middle">
      <ul class="showcase">
        <li>
          <div class="icon">
          <span class="number1">A1</span>
          </div>
          <small>N/A</small>
        </li>
        <li>
          <div class="icon selected">
          <span class="number1">A1</span>
          </div>
          <small>Selected</small>
        </li>
        <li>
          <div class="icon occupied"></div>
          <small>Occupied</small>
        </li>    
      </ul>
    </div>

    <div class="screen"></div>
</div>

<form action="seat1.php" method="POST">

<div class="theatre">
  <div class="cinema-seats left">
  <div class="cinema-row row-1">
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="A1") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="A1" value="A1">
    <span class="number">A1</span>
    <input type="checkbox" name="seats[]" value="A1">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="B1") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="B1" value="B1">
    <span class="number">B1</span>
    <input type="checkbox" name="seats[]" value="B1">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="C1") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="C1" value="C1">
    <span class="number">C1</span>
    <input type="checkbox" name="seats[]" value="C1">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="D1") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="D1" value="D1">
    <span class="number">D1</span>
    <input type="checkbox" name="seats[]" value="D1">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="E1") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="E1" value="E1">
    <span class="number">E1</span>
    <input type="checkbox" name="seats[]" value="E1">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="F1") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="F1" value="F1">
    <span class="number">F1</span>
    <input type="checkbox" name="seats[]" value="F1">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="G1") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="G1" value="G1">
    <span class="number">G1</span>
    <input type="checkbox" name="seats[]" value="G1">
  </div>
</div>

<div class="cinema-row row-2">
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="A2") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="A2" value="A2">
    <span class="number">A2</span>
    <input type="checkbox" name="seats[]" value="A2">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="B2") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="B2" value="B2">
    <span class="number">B2</span>
    <input type="checkbox" name="seats[]" value="B2">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="C2") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="C2" value="C2">
    <span class="number">C2</span>
    <input type="checkbox" name="seats[]" value="C2">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="D2") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="D2" value="D2">
    <span class="number">D2</span>
    <input type="checkbox" name="seats[]" value="D2">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="E2") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="E2" value="E2">
    <span class="number">E2</span>
    <input type="checkbox" name="seats[]" value="E2">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="F2") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="F2" value="F2">
    <span class="number">F2</span>
    <input type="checkbox" name="seats[]" value="F2">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="G2") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="G2" value="G2">
    <span class="number">G2</span>
    <input type="checkbox" name="seats[]" value="G2">
  </div>
</div>

<div class="cinema-row row-3">
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="A3") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="A3" value="A3">
    <span class="number">A3</span>
    <input type="checkbox" name="seats[]" value="A3">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="B3") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="B3" value="B3">
    <span class="number">B3</span>
    <input type="checkbox" name="seats[]" value="B3">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="C3") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="C3" value="C3">
    <span class="number">C3</span>
    <input type="checkbox" name="seats[]" value="C3">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="D3") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="D3" value="D3">
    <span class="number">D3</span>
    <input type="checkbox" name="seats[]" value="D3">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="E3") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="E3" value="E3">
    <span class="number">E3</span>
    <input type="checkbox" name="seats[]" value="E3">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="F3") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="F3" value="F3">
    <span class="number">F3</span>
    <input type="checkbox" name="seats[]" value="F3">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="G3") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="G3" value="G3">
    <span class="number">G3</span>
    <input type="checkbox" name="seats[]" value="G3">
  </div>
</div>
    
    
    
<div class="cinema-row row-4">
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="A4") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="A4" value="A4">
    <span class="number">A4</span>
    <input type="checkbox" name="seats[]" value="A4">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="B4") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="B4" value="B4">
    <span class="number">B4</span>
    <input type="checkbox" name="seats[]" value="B4">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="C4") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="C4" value="C4">
    <span class="number">C4</span>
    <input type="checkbox" name="seats[]" value="C4">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="D4") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="D4" value="D4">
    <span class="number">D4</span>
    <input type="checkbox" name="seats[]" value="D4">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="E4") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="E4" value="E4">
    <span class="number">E4</span>
    <input type="checkbox" name="seats[]" value="E4">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="F4") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="F4" value="F4">
    <span class="number">F4</span>
    <input type="checkbox" name="seats[]" value="F4">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="G4") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="G4" value="G4">
    <span class="number">G4</span>
    <input type="checkbox" name="seats[]" value="G4">
  </div>
</div>

<div class="cinema-row row-5">
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="A5") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="A5" value="A5">
    <span class="number">A5</span>
    <input type="checkbox" name="seats[]" value="A5">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="B5") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="B5" value="B5">
    <span class="number">B5</span>
    <input type="checkbox" name="seats[]" value="B5">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="C5") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="C5" value="C5">
    <span class="number">C5</span>
    <input type="checkbox" name="seats[]" value="C5">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="D5") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="D5" value="D5">
    <span class="number">D5</span>
    <input type="checkbox" name="seats[]" value="D5">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="E5") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="E5" value="E5">
    <span class="number">E5</span>
    <input type="checkbox" name="seats[]" value="E5">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="F5") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="F5" value="F5">
    <span class="number">F5</span>
    <input type="checkbox" name="seats[]" value="F5">
  </div>
  <div class="seat <?php 
    foreach($occupied as $o) {
      if($o=="G5") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="G5" value="G5">
    <span class="number">G5</span>
    <input type="checkbox" name="seats[]" value="G5">
  </div>
</div>
    



<div class="cinema-row row-6">
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="A6") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="A6" value="A6">
    <span class="number">A6</span>
    <input type="checkbox" name="seats[]" value="A6">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="B6") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="B6" value="B6">
    <span class="number">B6</span>
    <input type="checkbox" name="seats[]" value="B6">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="C6") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="C6" value="C6">
    <span class="number">C6</span>
    <input type="checkbox" name="seats[]" value="C6">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="D6") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="D6" value="D6">
    <span class="number">D6</span>
    <input type="checkbox" name="seats[]" value="D6">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="E6") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="E6" value="E6">
    <span class="number">E6</span>
    <input type="checkbox" name="seats[]" value="E6">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="F6") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="F6" value="F6">
    <span class="number">F6</span>
    <input type="checkbox" name="seats[]" value="F6">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="G6") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="G6" value="G6">
    <span class="number">G6</span>
    <input type="checkbox" name="seats[]" value="G6">
  </div>
</div>

<div class="cinema-row row-7">
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="A7") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="A7" value="A7">
    <span class="number">A7</span>
    <input type="checkbox" name="seats[]" value="A7">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="B7") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="B7" value="B7">
    <span class="number">B7</span>
    <input type="checkbox" name="seats[]" value="B7">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="C7") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="C7" value="C7">
    <span class="number">C7</span>
    <input type="checkbox" name="seats[]" value="C7">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="D7") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="D7" value="D7">
    <span class="number">D7</span>
    <input type="checkbox" name="seats[]" value="D7">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="E7") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="E7" value="E7">
    <span class="number">E7</span>
    <input type="checkbox" name="seats[]" value="E7">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="F7") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="F7" value="F7">
    <span class="number">F7</span>
    <input type="checkbox" name="seats[]" value="F7">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="G7") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="G7" value="G7">
    <span class="number">G7</span>
    <input type="checkbox" name="seats[]" value="G7">
  </div>
</div>
    


<div class="cinema-seats right">
  <div class="cinema-row row-1">
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="A8") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="A8" value="A8">
      <span class="number">A8</span>
      <input type="checkbox" name="seats[]" value="A8">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="B8") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="B8" value="B8">
      <span class="number">B8</span>
      <input type="checkbox" name="seats[]" value="B8">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="C8") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="C8" value="C8">
      <span class="number">C8</span>
      <input type="checkbox" name="seats[]" value="C8">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="D8") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="D8" value="D8">
      <span class="number">D8</span>
      <input type="checkbox" name="seats[]" value="D8">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="E8") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="E8" value="E8">
      <span class="number">E8</span>
      <input type="checkbox" name="seats[]" value="E8">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="F8") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="F8" value="F8">
      <span class="number">F8</span>
      <input type="checkbox" name="seats[]" value="F8">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="G8") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="G8" value="G8">
      <span class="number">G8</span>
      <input type="checkbox" name="seats[]" value="G8">
    </div>
  </div>

  <div class="cinema-row row-2">
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="A9") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="A9" value="A9">
      <span class="number">A9</span>
      <input type="checkbox" name="seats[]" value="A9">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="B9") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="B9" value="B9">
      <span class="number">B9</span>
      <input type="checkbox" name="seats[]" value="B9">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="C9") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="C9" value="C9">
      <span class="number">C9</span>
      <input type="checkbox" name="seats[]" value="C9">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="D9") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="D9" value="D9">
      <span class="number">D9</span>
      <input type="checkbox" name="seats[]" value="D9">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="E9") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="E9" value="E9">
      <span class="number">E9</span>
      <input type="checkbox" name="seats[]" value="E9">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="F9") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="F9" value="F9">
      <span class="number">F9</span>
      <input type="checkbox" name="seats[]" value="F9">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="G9") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="G9" value="G9">
      <span class="number">G9</span>
      <input type="checkbox" name="seats[]" value="G9">
    </div>
  </div>

  <div class="cinema-row row-3">
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="A10") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="A10" value="A10">
      <span class="number">A10</span>
      <input type="checkbox" name="seats[]" value="A10">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="B10") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="B10" value="B10">
      <span class="number">B10</span>
      <input type="checkbox" name="seats[]" value="B10">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="C10") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="C10" value="C10">
      <span class="number">C10</span>
      <input type="checkbox" name="seats[]" value="C10">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="D10") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="D10" value="D10">
      <span class="number">D10</span>
      <input type="checkbox" name="seats[]" value="D10">
    </div>
    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="E10") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="E10" value="E10">
      <span class="number">E10</span>
      <input type="checkbox" name="seats[]" value="E10">
    </div>

    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="F10") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="F10" value="F10">
      <span class="number">F10</span>
      <input type="checkbox" name="seats[]" value="F10">
    </div>

    <div class="<?php 
      foreach($occupied as $o) {
        if($o=="F11") {
          $seatOccupied=$o;
          break;
        } else {
          $seatOccupied="no";
        }
      }
      if($seatOccupied=="no") {
        echo "seat";
      } else {
        echo "occupied";
      }
    ?>" name="F11" value="F11">
      <span class="number">F11</span>
      <input type="checkbox" name="seats[]" value="F11">
    </div>
  </div>

  <div class="cinema-row row-4">
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="A11") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="A11" value="A11">
    <span class="number">A11</span>
    <input type="checkbox" name="seats[]" value="A11">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="B11") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="B11" value="B11">
    <span class="number">B11</span>
    <input type="checkbox" name="seats[]" value="B11">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="C11") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="C11" value="C11">
    <span class="number">C11</span>
    <input type="checkbox" name="seats[]" value="C11">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="D11") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="D11" value="D11">
    <span class="number">D11</span>
    <input type="checkbox" name="seats[]" value="D11">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="E11") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="E11" value="E11">
    <span class="number">E11</span>
    <input type="checkbox" name="seats[]" value="E11">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="F11") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="F11" value="F11">
    <span class="number">F11</span>
    <input type="checkbox" name="seats[]" value="F11">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="G11") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="G11" value="G11">
    <span class="number">G11</span>
    <input type="checkbox" name="seats[]" value="G11">
  </div>
</div>

<div class="cinema-row row-5">
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="A12") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="A12" value="A12">
    <span class="number">A12</span>
    <input type="checkbox" name="seats[]" value="A12">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="B12") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="B12" value="B12">
    <span class="number">B12</span>
    <input type="checkbox" name="seats[]" value="B12">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="C12") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="C12" value="C12">
    <span class="number">C12</span>
    <input type="checkbox" name="seats[]" value="C12">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="D12") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="D12" value="D12">
    <span class="number">D12</span>
    <input type="checkbox" name="seats[]" value="D12">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="E12") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="E12" value="E12">
    <span class="number">E12</span>
    <input type="checkbox" name="seats[]" value="E12">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="F12") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="F12" value="F12">
    <span class="number">F12</span>
    <input type="checkbox" name="seats[]" value="F12">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="G12") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="G12" value="G12">
    <span class="number">G12</span>
    <input type="checkbox" name="seats[]" value="G12">
  </div>
</div>

<div class="cinema-row row-6">
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="A13") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="A13" value="A13">
    <span class="number">A13</span>
    <input type="checkbox" name="seats[]" value="A13">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="B13") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="B13" value="B13">
    <span class="number">B13</span>
    <input type="checkbox" name="seats[]" value="B13">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="C13") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="C13" value="C13">
    <span class="number">C13</span>
    <input type="checkbox" name="seats[]" value="C13">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="D13") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="D13" value="D13">
    <span class="number">D13</span>
    <input type="checkbox" name="seats[]" value="D13">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="E13") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="E13" value="E13">
    <span class="number">E13</span>
    <input type="checkbox" name="seats[]" value="E13">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="F13") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="F13" value="F13">
    <span class="number">F13</span>
    <input type="checkbox" name="seats[]" value="F13">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="G13") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="G13" value="G13">
    <span class="number">G13</span>
    <input type="checkbox" name="seats[]" value="G13">
  </div>
</div>

<div class="cinema-row row-7">
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="A14") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="A14" value="A14">
    <span class="number">A14</span>
    <input type="checkbox" name="seats[]" value="A14">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="B14") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="B14" value="B14">
    <span class="number">B14</span>
    <input type="checkbox" name="seats[]" value="B14">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="C14") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="C14" value="C14">
    <span class="number">C14</span>
    <input type="checkbox" name="seats[]" value="C14">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="D14") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="D14" value="D14">
    <span class="number">D14</span>
    <input type="checkbox" name="seats[]" value="D14">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="E14") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="E14" value="E14">
    <span class="number">E14</span>
    <input type="checkbox" name="seats[]" value="E14">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="F14") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="F14" value="F14">
    <span class="number">F14</span>
    <input type="checkbox" name="seats[]" value="F14">
  </div>
  <div class="<?php 
    foreach($occupied as $o) {
      if($o=="G14") {
        $seatOccupied=$o;
        break;
      } else {
        $seatOccupied="no";
      }
    }
    if($seatOccupied=="no") {
      echo "seat";
    } else {
      echo "occupied";
    }
  ?>" name="G14" value="G14">
    <span class="number">G14</span>
    <input type="checkbox" name="seats[]" value="G14">
  </div>
</div>


    </div>
  </div>
</div>
<div class="textDetail">
  <span class="detail"><input type="submit" name="cancel" class="custom-button" value="cancel" style="margin-right:15px;
" ><span class="detail">
  <button name="submit" class="custom-button" onclick="return confirm('Are you sure that you want to choose these seat?')">Submit</button>
</span>

</div> 
</form>


<script>
  const seats = document.querySelectorAll('.seat');

  seats.forEach((seat) => {
    seat.addEventListener('click', (event) => {
      if (seat.classList.contains('occupied')) {
        // Seat is already occupied
        return;
      }

      seat.classList.toggle('selected');
      const checkbox = seat.querySelector('input[type="checkbox"]');
      checkbox.checked = !checkbox.checked;
    });
  });


  $(document).ready(function() {
  $('input[type="checkbox"]').on('change', function() {
    $(this).parent('.seat').toggleClass('selected');
  });
});



</script>


</body>
</html>