<?php 

class forgot
{
    public $conn;
    public function __construct($server, $username, $password, $database) // Constructor method
	{
        $this->conn = mysqli_connect($server, $username, $password, $database); //connect to the database
        if (!$this->conn) { // if connect fail 
            die("Connect failed: " .$this->conn.mysqli_connect_error()); 
        }
    }

//generate a random verify
    function generate_random_password() 
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; //random the number from these char
        $password = "";
        for ($i = 0; $i < 8; $i++) 
        {
          $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $password;
      }

    //send the Verify to the user's email
    function send_password_email($email, $new_verify) 
    {
        $to = "$email";
        $subject = "Request For Password Change";
        $message = "Hello, We Had Received A Request To Change Your Password For Your Account. 
        This Is Your Verification Code To Change Your Password:
        $new_verify";
        $headers = "From: phptesting00@gmail.com";

        mail($to, $subject, $message, $headers);
    }
    public function getVerify($email)
    {
        $check_query="SELECT * FROM user WHERE email = '$email'";
        $result=mysqli_query($this->conn,$check_query);
        $row=mysqli_num_rows($result);
        if($row==1)
        {
            $verify = $this->generate_random_password();//use  the function for generating the random password

            // Send the new password to the user's email
            $this->send_password_email($email, $verify);
            echo "Your new verification code has been sent to your email.";
            session_start();//save the code value;
            $_SESSION["code"]=$verify;  
            $_SESSION["email"]=$email;
            header("location:changePwd.php");//go revise the password
        }
        else
        {
            echo "Email not found";
        }
        mysqli_close($this->conn);
    }
    public function changePwd($email,$pwd)
    {
        $email=strtolower($email); //lowercacse for the email
        $check_query="SELECT *From user Where email='$email'";
        $row=mysqli_num_rows(mysqli_query($this->conn,$check_query));

        if($row==1)
        {
            $pwd = password_hash($pwd, PASSWORD_DEFAULT); // secure the password for preventing hacker
            $sql="UPDATE user set 
            password='$pwd' where email='$email'";
            mysqli_query($this->conn,$sql);
            echo "<script>
            alert(' Successful to change the password!!!!!');
            window.location.href = '../profile.php'; 
            </script>";//header to the admin page with the reminder
        }
        else
        {
            echo "We Are Currently Facing Technical Issue 
            Please Try Again Later";
        }
        mysqli_close($this->conn);
    }
    

}




class Validation
{
    function test_input($data) // format the string
    {
    $data = trim($data); //delete the space if the input
    $data = stripslashes($data); // removes backslashes
    $data = htmlspecialchars($data); //converts special characters to their HTML entities
    return $data;
    }
    private $userErro,$passwordErr,$emailErr;
    public $register; // for restricting the login and register
    public function __construct($userErro,$passwordErr,$emailErr)// construct the class
    {
        $this->userErro=$userErro;
        $this->passwordErr=$passwordErr;
        $this->emailErr=$emailErr;        
        $this->register=0;
    }
    public function ErrID() //restrict the input for username
    {
        $error=$this->userErro; // showing the error message 
        if(empty($error)) // showing the message if the value is empty 
        {
            $error="*Name is required";
        }
        else //the value is not empty 
        {
            $tem= $this->test_input($error); //use the function 
            if(strlen($error)<4) // count the string length 
            {
                $error="*At least 4 digit";
            }
            else if(strlen($error)<=200)
            {
                if (!preg_match("/^[a-zA-Z0-9 ]*$/",$tem))  // the users is only able to enter A-Z/a-z/0-9
                {
                    $error="Only letters,number and white space allowed";
                    $this->register=0; //return the value
                }
                else 
                {
                    $error=""; //clear the value
                    $this->register+=1;
                }
            }
            else
            {
                $error="Your Name is too long";
            }
        }
        return $error;
    }
    public function ErrPassword()
    {
        $error=$this->passwordErr ;
        if(empty($error))// showing the message if the value is empty 
        {
            $error="*Password is required";
        }
        else
        {
            $tem= $this->test_input($error); //use the function 
            if(strlen($error)<8)// count the string length 
            {
                $error="*At least 8 digit";
            }
            else if(strlen($error)<=200)
            {
                if (!preg_match("/^[a-zA-Z0-9]*$/",$tem)) // the users is only able to enter A-Z/a-z/0-9
                {
                    $error="*Only letters and number allowed";
                    $this->register=0;//return the value

                }
                else
                {
                    $error="";//clear the value
                    $this->register+=1;                
                }
            }
            else
            {
                $error="Your Password is too long";
            }
        }
        return $error;
    }
    public function ErrEmail()
    {
        $error=$this->emailErr;
        if(empty($error))// showing the message if the value is empty 
        {
            $error="*Email is required";
        }
        else
        {
            $tem= $this->test_input($error);//use the function 
                if (!filter_var($tem, FILTER_VALIDATE_EMAIL)) // the users is only able to enter email form
                {
                    $error = "Invalid email format";
                    $this->register=0;//return the value
                }
                else
                {
                    $error="";//clear the value
                    $this->register+=1;                
                }
        }
        return $error;
    }

}
?>