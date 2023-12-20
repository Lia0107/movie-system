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

    public function checkUserAdmin($email, $password, $fname, $lname, $phoneNo, $gender,$image) 
    {
        $errorMsg = "";
        $sql = "SELECT * FROM user WHERE LOWER(email) = LOWER('$email')";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 1) {
            $errorMsg="The email is repeated";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user(firstName, lastName, phoneNumber, email, password, gender,image) 
                    VALUES ('$fname', '$lname', '$phoneNo', '$email', '$hashedPassword', '$gender','$image')";
            $errorMsg="";
            $result = $this->conn->query($sql);
            session_start();
            $_SESSION["email"] = $email;
            header("location: user_details.php");
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

    public function UploadMovie($movieName, $Synopsis, $Director, $Starring, $RunningTime, $Genre, $image, $status, $Trailers, $Fee, $Date, $package, $language) 
    {
        $errorMsg = "";
        $sql = "INSERT INTO movie (movieName, Synopsis, Director, Starring, RunningTime, Genre, image, status, Trailers, Fee, Date, package, language) 
                VALUES ('$movieName', '$Synopsis', '$Director', '$Starring', '$RunningTime', '$Genre', '$image', '$status', '$Trailers', '$Fee', '$Date', '$package', '$language')";
        
        $result = $this->conn->query($sql);
    
        header("location: admin_movie_details.php");
    }

    public function updateMovie($movieID, $movieName, $Synopsis, $Director, $Starring, $RunningTime, $Genre, $image, $status, $Trailers, $Fee, $Date, $package, $language) 
    {
        $check_query = "SELECT * FROM movie WHERE movieID ='$movieID'";
        $result = mysqli_query($this->conn, $check_query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            // Movie exists, perform the update operation
            $sql = "UPDATE movie SET movieName = '$movieName', Synopsis = '$Synopsis', Director = '$Director', Starring = '$Starring', RunningTime = '$RunningTime', Genre = '$Genre', image = '$image', status = '$status', Trailers = '$Trailers', Fee = '$Fee', Date = '$Date', package = '$package', language = '$language' WHERE movieID = '$movieID'";
            
            if (mysqli_query($this->conn, $sql)) {
                // Update successful
                header("location: admin_movie_details.php");
            } else {
                // Error executing update query
                echo "Error updating movie: " . mysqli_error($this->conn);
            }
        } else {
            // Movie does not exist
            echo "Movie not found.";
        }
    }
    
    public function updateProduct($productID, $productName, $price, $image) 
    {
        $check_query = "SELECT * FROM product WHERE productID ='$productID'";
        $result = mysqli_query($this->conn, $check_query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            // Movie exists, perform the update operation
            $sql = "UPDATE product SET productID = '$productID', productName = '$productName', price = '$price', image = '$image' WHERE productID = '$productID'";
            
            if (mysqli_query($this->conn, $sql)) {
                // Update successful
                header("location: admin_product_details.php");
            } else {
                // Error executing update query
                echo "Error updating product: " . mysqli_error($this->conn);
            }
        } else {
            // Movie does not exist
            echo "Product not found.";
        }
    }
    public function UploadProduct($productName, $price, $image) 
    {
        $errorMsg = "";
        $sql = "INSERT INTO product (productName, price, image) 
                VALUES ('$productName', '$price', '$image')";
        
        $result = $this->conn->query($sql);
    
        header("location: admin_product_details.php");
    }
    
}
?>
