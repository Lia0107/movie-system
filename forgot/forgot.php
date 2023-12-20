<?php 
  include "forgotObject.php";
  $forgot= new forgot("localhost", "email", "password", "cinema");
  $vali = new Validation ("","",isset($_POST["email"]) ? $_POST["email"] : "");//connect to the object oriented of validation for showing the validation to users
  $emailErr="";
  if(isset($_POST["submit"]))
  {
    $emailErr=$vali->ErrEmail(); 
    if($vali->register==1)
    {
      $email=isset($_POST["email"])?$_POST["email"]:"";
      $forgot->getVerify($email);
    }
    else
    {
      echo "<script>
      alert('$emailErr');
      </script>";
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style01.css">
  </head>

  <form action="forgot.php" method="post">
    <h1>Forgot Password?</h1>
    <div class="form-group">
      <label for="email">Enter Your Email:</label>
      <input type="email" id="email" name="email" >
    </div>
    <button type="submit"  name="submit">Submit</button>
  </form>
</html>