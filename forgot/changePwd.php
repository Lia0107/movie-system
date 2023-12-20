<?php 
include "forgotObject.php";
$vali = new Validation ("",isset($_POST["password"]) ? $_POST["password"] : "","");//connect to the object oriented of validation for showing the validation to users
$forgot= new forgot("localhost", "email", "password", "cinema");
$passwordErr=$errorP="";

function test_input($data){ // format the string
    $data = trim($data); //delete the space if the input
    $data = stripslashes($data); // removes backslashes
    $data = htmlspecialchars($data); //converts special characters to their HTML entities
    return $data;
}

session_start();
$verifyCode=isset($_SESSION["code"])?$_SESSION["code"]:"Wronggg";
$email=isset($_SESSION["email"])?$_SESSION["email"]:"";
$code=null;
if(isset($_POST["submit"])){
    $code=isset($_POST["forgot"])?$_POST["forgot"]:"";
    $code=test_input($code);//format the string
    if($code!=$verifyCode){
        echo "<script>
        alert('Invalid Verification Code');
        </script>";
        $code=null;
    }

}

if(isset($_POST["change"]))
{
    $errorP=$passwordErr=$vali->ErrPassword(); 
    if($vali->register==1)
    {
        $pwd=isset($_POST["password"])?$_POST["password"]:"";
        $forgot->changePwd($email,$pwd);
    }
    else
    {
        echo "<script>
        alert('$errorP');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
            <link rel="stylesheet" href="style02.css">
    </head>

    <body>
        <form action="changePwd.php" method="POST">
            <?php if(!isset($code)) {?>
                <h2>An 8-Digit Verification Code Has Been Sent To Your Email.</h2>
                <input type="text" name="forgot" placeholder=" 8-Digit Code"><br><br>
                <button type="submit" value="Enter" name="submit">Submit</button>
            <?php }
            if($verifyCode==$code) // able to change the password if the code is successfuk 
            { ?>
                <h2>Verification Successful!<br>Enter new Password: </h2>
                <input type="password" name="password" placeholder=" New Password"><br><br>
                <button type="submit" value="Enter" name="change">Change</button>
            <?php }
            ?>
        </form>
    </body>
</html>