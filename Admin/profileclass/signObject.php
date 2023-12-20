<?php
include "profileclass/dbcon.php";

class Signup extends dbcon {
    public function checkUser($email, $password, $fname, $lname, $phoneNo, $gender) {
        $errorMsg = "";
        $sql = "SELECT * FROM user WHERE LOWER(email) = LOWER('$email')";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 1) {
            $errorMsg="The email is repeated";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user(firstName, lastName, phoneNumber, email, password, gender) 
                    VALUES ('$fname', '$lname', '$phoneNo', '$email', '$hashedPassword', '$gender')";
            $errorMsg="";
            $result = $this->conn->query($sql);
            session_start();
            $_SESSION["email"] = $email;
            header("location: ../User/user_profile_edit.php");
        }
        mysqli_close($this->conn);
        return $errorMsg;
    }

    public function login($email, $password) 
    {
        $email=strtolower($email); //lowercacse for the email
        $check_query = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking the output and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows

        if ($check_result == 1) { //if the number is one that mean the account is existed
            $user = mysqli_fetch_assoc($result);//store the account as a array
            if (password_verify($password, $user['password'])) {  //verify the password matches a hash.
                $sql="SELECT * From user WHERE email='$email'";
                $result=mysqli_query($this->conn,$sql);
                $row=mysqli_fetch_assoc($result);
                $username=$row["lastName"];
                $userID=$row["user_id"];
                session_start();
                $errorP=" "; //clear the reminder to be null;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;
                $_SESSION['userID'] =$userID;
                header("location: index-2.php"); 
            } 
            else 
            {
                $errorP="Username or password is incorrect";
            }
        } else {//the account is not existed or invalid password or ID
            $errorP="Username or password is incorrect";
        }
        mysqli_close($this->conn);
        return $errorP;
    }
}
?>
