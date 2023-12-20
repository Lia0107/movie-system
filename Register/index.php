   
<?php
  
   session_start();
   include "classes/signClass.php";
   include "classes/signControl.php";
   
   $signup = new Signup("localhost", "email", "password", "cinema");
   
   $email = isset($_POST["email"]) ? $_POST["email"] : "";
   $password = isset($_POST["password"]) ? $_POST["password"] : "";
   $fname = isset($_POST["fname"]) ? $_POST["fname"] : "";
   $lname = isset($_POST["lname"]) ? $_POST["lname"] : "";
   $phoneNo = isset($_POST["phoneNo"]) ? $_POST["phoneNo"] : "";
   $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
   
   
   $userID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : "";
   $reg = new signCtrl($fname, $lname, $phoneNo, $email, $password, $gender);
   
   $errorMsg = "";
   $fnameErr = "";
   $lnameErr = "";
   $phoneErr = "";
   $mailErr = "";
   $pwErr = "";
   $image="facebookanon.jpg";
   if (isset($_POST["submit"])) 
   {
	   $fnameErr = $reg->Errorfname();
	   $lnameErr = $reg->Errorlname();
	   $phoneErr = $reg->Errorph();
	   $mailErr = $reg->Errorm();
	   $pwErr = $reg->Errorpw();
	   
		if(empty($fnameErr) AND empty($lnameErr) AND empty($phoneErr) AND empty($mailErr) AND empty($pwErr) AND empty($genderErr))
		{
			$errorMsg=$signup->checkUser($email, $password, $fname, $lname, $phoneNo, $gender,$image);
			header("location:../Mainpage/index-2.php");
		}

   }
   ?>
   
   <!DOCTYPE html>
   <html>
   
   <head>
	   <meta charset="utf-8">
	   <title>Form</title>
	   <link href="test.css" type="text/css" rel="stylesheet">
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   
   <body>
	   <!-- Body of Form starts -->
	   <div class="container">
		   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete="on">
		   <h1 style="color:rgb(255, 255, 255);text-align: center;padding-bottom: 20px;">User Sign Up</h1>
    		<div class="box">
          <label for="firstName" class="fl fontLabel"> First Name: </label>
    			<div class="new iconBox">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
		  <?php 
			   
			   if ($errorMsg == "") {
				   // If the error is empty, this row does not appear
   
			   } else {
				   // If the error is not empty, display the error message
				   ?>
				   <span class="Error"><?php echo $errorMsg; ?></span>
			   <?php }
			   ?>
			   <?php 
			   
			   if ($fnameErr == "") {
				   // If the error is empty, this row does not appear
   
			   } else {
				   // If the error is not empty, display the error message
				   ?>
				   <span class="Error"><?php echo $fnameErr; ?></span>
			   <?php }
			   ?>
			   <div class="fr">
			   <input type="text" name="fname" placeholder="First Name" class="textBox" autofocus="on" >
			   </div>
    			<div class="clr"></div>
    			</div>
			   <div class="box">
			   <label for="secondName" class="fl fontLabel"> Second Name: </label>
			   <div class="fl iconBox"><i class="fa fa-user" aria-hidden="true"></i></div>
			   <div class="fr">
			   <?php
			   if ($lnameErr == "") {
				   // If the error is empty, this row does not appear
   
			   } else {
				   // If the error is not empty, display the error message
				   ?>
				   <span class="Error"><?php echo $lnameErr; ?></span>
			   <?php } ?>
			   
			   <input type="text"  name="lname" placeholder="Last Name" class="textBox">	   
			   </div>
    			<div class="clr"></div>
    			</div>
				<div class="box">
          		<label for="phone" class="fl fontLabel"> Phone No.: </label>
    			<div class="fl iconBox"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
    			<div class="fr">
			 	<?php
			   if ($phoneErr == "") {
				   // If the error is empty, this row does not appear
   
			   } else {
				   // If the error is not empty, display the error message
				   ?>
				   <span class="Error"><?php echo $phoneErr; ?></span>
			   <?php
			   }
			   ?>
			   <input type="text"  name="phoneNo" maxlength="10" placeholder="Phone No." class="textBox">
			   </div>
    			<div class="clr"></div>
    			</div>
				<div class="box">
          		<label for="email" class="fl fontLabel"> Email ID: </label>
    			<div class="fl iconBox"><i class="fa fa-envelope" aria-hidden="true"></i></div>
    			<div class="fr">
			  <?php
			   if ($mailErr == "") {
				   // If the error is empty, this row does not appear
   
			   } else {
				   // If the error is not empty, display the error message
				   ?>
				   <span class="Error"><?php echo $mailErr; ?></span>
			   <?php
			   }
			   ?>
			   <input type="email"  name="email" placeholder="Email Id" class="textBox">
			   </div>
    			<div class="clr"></div>
    			</div>
				<div class="box">
          		<label for="password" class="fl fontLabel"> Password:</label>
    			<div class="fl iconBox"><i class="fa fa-key" aria-hidden="true"></i></div>
    			<div class="fr">
			   <?php
			   if ($pwErr == "") {
				   // If the error is empty, this row does not appear
   
			   } else {
				   // If the error is not empty, display the error message
				   ?>
				   <span class="Error"><?php echo $pwErr; ?></span>	
			   <?php
			   }
			   ?>
			   <input type="Password"  name="password" placeholder="Password" class="textBox">
			   </div>
    			<div class="clr"></div>
    		</div>
			<div class="box radio">
          	<label for="gender" class="gd"> Gender: </label>
				   <input type="radio" name="gender" <?php if (isset($gender) && $gender == "Male") echo "checked"; ?> value="Male" required> Male &nbsp; &nbsp; &nbsp; &nbsp;
				   <input type="radio" name="gender" <?php if (isset($gender) && $gender == "Female") echo "checked"; ?> value="Female" required> Female

			   </div>
			   <div class="box terms">
			   <input type="checkbox" name="Terms" required>&nbsp; I accept the terms and conditions
			   <input type="Submit" name="submit" class="submit" value="SUBMIT">
		   </form>
	   </div>
   </body>
   
   </html>
  