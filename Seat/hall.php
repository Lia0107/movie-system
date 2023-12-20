<?php 
session_start();
$room=empty($_SESSION["room"])?"":$_SESSION["room"];

if($room==1)
{
    header("location:seat1.php");
}
else if($room==2)
{
    header("location:seat2.php");

}
else if($room==3)
{
    header("location:seat3.php");

}
else if($room==4)
{
    header("location:seat4.php");

}
else if($room==5)
{
    header("location:seat5.php");

}

?>