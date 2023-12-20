<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
  </head>
    <body>
      <form action="admin_login.php" method="POST" class='form'>
      <?php 
        include ("../database/database.php");
          $emailErr=$passwordErr="";
          $email=isset($_POST["email"])?$_POST["email"]:"";
          $password=isset($_POST["password"])?$_POST["password"]:"";
          $login = new Login("localhost", "email", "password", "cinema"); //connect to the object oriented of SQL for connecting the database
          $errorP=" ";//warning for unsuccessfully log in
          if(isset($_POST["login"]))
          {
              if(!empty($email) && !empty($password)) //all of tha validation is vali 
              {   
                $errorP=$login->AdminLogin($email, $password); //object oriented for log in           
              }
              else
              {
                echo "<script>
                alert('Please, enter the required field!');
                window.location.href = 'admin_login.php';
                </script>"; //header to the navigation page with the reminder
              }
          }
      
    ?>
        <div class='control'>
          <h1>
            Administrator Sign In
          </h1>
          <span class="error"><?php echo $errorP."<br>".$emailErr."<br>".$passwordErr;?></span>
        </div>
        <div class='control block-cube block-input'>
          <input name='email' placeholder='Email' type='text'>
          <div class='bg-top'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg-right'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg'>
            <div class='bg-inner'></div>
          </div>
        </div>
        <div class='control block-cube block-input'>
          <input name='password' placeholder='Password' type='password'>
          <div class='bg-top'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg-right'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg'>
            <div class='bg-inner'></div>
          </div>
        </div>
        <button class='btn block-cube block-cube-hover' type='submit' name="login">
          <div class='bg-top'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg-right'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg'>
            <div class='bg-inner'></div>
          </div>
          <div class='text'>
            Log In
          </div>
        </button>
      </form>
      
    </body>
  <?php


  ?>
</html>