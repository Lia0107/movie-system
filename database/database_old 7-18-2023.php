<?php
class Login {
    public $conn;
    public $email;
    public function __construct($server, $username, $password, $database) // Constructor method
	{
        $this->conn = new mysqli($server, $username, $password, $database); //connect to the database
        if (!$this->conn) { // if connect fail 
            die("Connect failed: " .$this->conn.mysqli_connect_error()); 
        }
    }

    public function AdminLogin($email, $password)  // this is for admin login 
    {
        $email=strtolower($email); //lowercacse for the email
        $check_query = "SELECT * FROM admin WHERE email='$email' and password='$password'";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking the output and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows

        if ($check_result == 1) 
        { //if the number is one that mean the account is existed
                session_start();
                $errorP=" "; //clear the reminder to be null;
                $_SESSION['email'] = $email;
                header("location: ../Admin/user_details.php"); 
                exit();
            } 
         else 
         {//the account is not existed or invalid password or ID
            $errorP="Username or password is incorrect";
        }
        mysqli_close($this->conn);
        return $errorP;
    } 

    public function uploadTicket($date, $movieID, $seatID,$branch,$packageID,$movieOftime,$userID,$room) 
    {

        $check_query = "SELECT * FROM bookingfilm WHERE movieOfdate ='$date' AND movieID='$movieID' AND branch='$branch' AND seatID='$seatID' AND packageID='$packageID' AND movieOftime='$movieOftime'";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows
        $movieOftime = $movieOftime;
        $convertedTime = date('H:i', strtotime($movieOftime)); // Converts '4:39PM' to '16:39'
        if ($check_result == 0) {
            $sql = "INSERT INTO bookingfilm (movieOfdate , movieID, seatID, branch, packageID, movieOftime,userID,Room) 
            VALUES ('$date', '$movieID', '$seatID','$branch','$packageID','$convertedTime','$userID',$room)";
            mysqli_query($this->conn,$sql);//connect to database for checking the output
        }
        else
        {
            Die("The seat has been select!!");
        } 

    }
    
    public function isOccupied($date, $movieID,$branch,$packageID,$movieOftime)
    {
        $movieOftime = $movieOftime;
        $convertedTime = date('H:i', strtotime($movieOftime)); // Converts '4:39PM' to '16:39'
        $check_query = "SELECT * FROM bookingfilm WHERE movieOfdate ='$date' AND movieID='$movieID' AND branch='$branch' AND packageID='$packageID' AND movieOftime='$convertedTime'";
        $result = mysqli_query($this->conn, $check_query);
    
        $occupiedSeats = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $occupiedSeats[] = $row["seatID"];
            }
        }
        else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
    
        return $occupiedSeats;
    }
    
    public function showMainMovie()
    {
        $check_query = "SELECT * FROM Movie";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
    
        return $Movie;
    }

    public function showMainTopMovie()
    {
        $check_query = "SELECT * FROM Movie  ORDER BY movieID desc";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }
    
    public function showMainTrailer()
    {
        if (!isset($this->result) || !$this->result) {
            $check_query = "SELECT * FROM Movie  ORDER BY movieID DESC LIMIT 3";
            $this->result = mysqli_query($this->conn, $check_query);
        }
    
        $row = mysqli_fetch_assoc($this->result);
        return $row;
    }
    

    public function showMainLatestMovie()
    {
        $check_query = "SELECT * FROM Movie WHERE status = 'released' ORDER BY movieID desc";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }

    public function getMovieDetail($movieID)
    {
        $check_query = "SELECT * FROM movie WHERE movieID='$movieID'";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "No movie found with ID: " . $movieID;
            return null;
        }
    }

    public function getBranch($branchID)
    {
        $check_query = "SELECT * FROM branch WHERE branchID='$branchID'";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return null;
        }
    }
   
    public function getPackageDetail($packageID)
    {
        $check_query = "SELECT * FROM package WHERE packageID='$packageID'";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            // If the query returned a result with at least one row
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            // If the query did not return any results
            echo "No package found with ID: " . $packageID;
            return null;
        }
    }

    public function findMovie($title)
    {
        $check_query = "SELECT * FROM Movie WHERE movieName like '%$title%'";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }    

    public function findPackage($title)
    {
        $check_query = "SELECT * FROM package WHERE packageName like '%$title%'";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }   

    public function findBranch($title)
    {
        $check_query = "SELECT * FROM branch WHERE branchName like '%$title%'";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }   
 
    public function findDirector($keywork)
    {
        $check_query = "SELECT * FROM Movie WHERE Director like '%$keywork%'";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    } 
    public function findStarring($keywork)
    {
        $check_query = "SELECT * FROM Movie WHERE Starring like '%$keywork%'";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    } 
    public function findGenre($keywork)
    {
        $check_query = "SELECT * FROM Movie WHERE Genre like '%$keywork%'";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    } 


    public function findlanguage($keywork)
    {
        $check_query = "SELECT * FROM Movie WHERE language like '%$keywork%'";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    } 
    
    public function displayBranch()
    {
        $check_query = "SELECT * 
        FROM branch";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }    


    public function displayPackage($movieID)
    {
        $check_query = "SELECT DISTINCT p.packageID, p.packageName
        FROM moviepurchase m, package_movie s, package p
        WHERE m.movieID = '$movieID'
          AND m.movieID = s.movieID
          AND m.branchID = s.branchID
          AND m.dateOfmovie = s.dateOfmovie
          AND s.packageID = p.packageID;";
          
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }      
     
    public function displayShowDate($movieID,$branchID)
    {
        $check_query = "SELECT DISTINCT m.dateOfmovie
        FROM moviepurchase m, package_movie s, package p
        WHERE m.movieID = '$movieID'
        AND m.movieID = s.movieID
        AND m.branchID = s.branchID
        AND m.dateOfmovie = s.dateOfmovie
        AND s.packageID = p.packageID
        AND m.branchID = '$branchID'
        AND m.dateOfmovie >= CURDATE()";

        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }    

    public function displayShowtime($movieID,$packageID,$dateOfmovie,$branchID)
    {

        $check_query = "SELECT  TIME_FORMAT(timeOfmovie, '%h:%i %p') AS timeOfmovie,packageID,dateOfmovie,Room
        FROM package_movie
        WHERE movieID = '$movieID' AND branchID = '$branchID' AND packageID = '$packageID' AND dateOfmovie = '$dateOfmovie';";

        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }    

    public function uploadQr($itemName, $itemDetail, $amount,$method,$userID,$qrCode,$movieID,$movieOftime,$movieOfdate) 
    {

        $check_query = "SELECT * FROM bill WHERE itemName ='$itemName' AND itemDetail='$itemDetail' AND amount='$amount' AND method='$method' AND userID='$userID' 
        AND qrCode='$qrCode' AND movieID='$movieID' AND movieOftime='$movieOftime' AND movieOfdate='$movieOfdate' ";

        $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows


        if ($check_result == 0) 
        {
            $sql = "INSERT INTO bill (paymentID, itemName, itemDetail, amount, method, userID, qrCode, movieID, movieOftime, movieOfdate) 
            VALUES ('', '$itemName', '$itemDetail', '$amount', '$method', '$userID', '$qrCode', '$movieID', '$movieOftime', '$movieOfdate')";
    
            mysqli_query($this->conn,$sql);//connect to database for checking the output
            
            $paymentID = mysqli_insert_id($this->conn); // Retrieve the auto-generated paymentID
        
            // Store the paymentID in a session variable
            $_SESSION["paymentID"] = $paymentID;
        }
        else
        {
            Die("The Pickture has been updated!!");
        } 
    }
    
    public function deleteBill($paymentID)
    {
        $sql = "DELETE FROM bill WHERE paymentID = '$paymentID'";
        
        if (mysqli_query($this->conn, $sql)) {
            echo "Row deleted successfully.";
        } else {
            echo "Error deleting row: " . mysqli_error($this->conn);
        }
    }

    public function getQr($paymentID)
    {
        $check_query = "SELECT * FROM bill WHERE paymentID = '$paymentID'";
        $result = mysqli_query($this->conn, $check_query);
        $row = mysqli_fetch_assoc($result);
    
        return $row;
    }

    public function getUserDetail($user_ID)
    {
        $check_query = "SELECT * FROM user WHERE user_id='$user_ID'";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "No movie found with ID: " . $user_ID;
            return null;
        }
    }

    public function updateuserdetails($userID, $fname, $lname, $phoneNo, $gender,$image) 
    {
        $check_query = "SELECT * FROM user WHERE user_id ='$userID'";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows

        if ($check_result == 1) 
        {
            $sql = "UPDATE user SET firstName = '$fname', lastName = '$lname', phoneNumber = '$phoneNo', gender = '$gender', image='$image' WHERE user_id = '$userID' ";
            if (mysqli_query($this->conn, $sql)) 
            {
                echo "Changes saved successfully.";
                header("location:profile.php");
            } else {
                echo "Error updating data: " . mysqli_error($this->conn);
            }
        } else {
            die("Unable to save changes.");
        }
        
    }

    public function getPackage()
    {
        $check_query = "SELECT * FROM package";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }

    public function getBill($userID)
    {
        $check_query = "SELECT * FROM bill where userID='$userID'";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }
  
    public function isEmailExists($userID, $fname, $lname, $phoneNo, $gender,$image,$email) 
    {
        $check_query = "SELECT * FROM user WHERE email ='$email'";
        $result = mysqli_query($this->conn, $check_query);
        $check_result = mysqli_num_rows($result);
    
        if ($check_result == 0) {
            $sql = "UPDATE user SET firstName = '$fname', email = '$email', lastName = '$lname', phoneNumber = '$phoneNo', gender = '$gender', image='$image' WHERE user_id = '$userID' ";

            if (mysqli_query($this->conn, $sql)) {
                echo "Changes saved successfully.";
                header("location: profile.php");
            } else {
                echo "Error updating data: " . mysqli_error($this->conn);
            }
        } else {
            $message = "Email is repeated!!";
        }
        return $message;
    }

    public function getUserTotal($userID)
    {
        $check_query = "SELECT SUM(amount) AS totalAmount FROM bill WHERE userID = '$userID'";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalAmount'];
        } else {
            echo "No amount to show for userID: " . $userID;
            return 0; // Return a default value if no amount is found
        }
    }

    public function userDetail()
    {
        $check_query = "SELECT * FROM user ";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }    

    public function updateuserdetailsAdmin($userID, $fname, $lname, $phoneNo, $gender,$image) 
    {
        $check_query = "SELECT * FROM user WHERE user_id ='$userID'";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows

        if ($check_result == 1) 
        {
            $sql = "UPDATE user SET firstName = '$fname', lastName = '$lname', phoneNumber = '$phoneNo', gender = '$gender', image='$image' WHERE user_id = '$userID' ";
            if (mysqli_query($this->conn, $sql)) 
            {
                echo "Changes saved successfully.";
                header("location:user_details.php");
            } else {
                echo "Error updating data: " . mysqli_error($this->conn);
            }
        } else {
            die("Unable to save changes.");
        }
    }


    public function updatebranchAdmin($branchID,$branchName, $phoneNumber, $address) 
    {
        $check_query = "SELECT * FROM branch WHERE branchID ='$branchID'";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows

        if ($check_result == 1) 
        {
            $sql = "UPDATE branch SET branchName = '$branchName', phoneNumber = '$phoneNumber', address = '$address' WHERE branchID = '$branchID' ";
            if (mysqli_query($this->conn, $sql)) 
            {
                echo "Changes saved successfully.";
                header("location:admin_branch_details.php");
            } else {
                echo "Error updating data: " . mysqli_error($this->conn);
            }
        } else {
            die("Unable to save changes.");
        }
    }


    public function isEmailExistsAdmin($userID, $fname, $lname, $phoneNo, $gender,$image,$email) 
    {
        $check_query = "SELECT * FROM user WHERE email ='$email'";
        $result = mysqli_query($this->conn, $check_query);
        $check_result = mysqli_num_rows($result);
    
        if ($check_result == 0) {
            $sql = "UPDATE user SET firstName = '$fname', email = '$email', lastName = '$lname', phoneNumber = '$phoneNo', gender = '$gender', image='$image' WHERE user_id = '$userID' ";

            if (mysqli_query($this->conn, $sql)) {
                echo "Changes saved successfully.";
                header("location: user_details.php");
            } else {
                echo "Error updating data: " . mysqli_error($this->conn);
            }
        } else {
            $message = "Email is repeated!!";
        }
        return $message;
    }


    public function deleteUser($userID)
    {
        $sql = "DELETE FROM user WHERE user_id = '$userID'";
        
        if (mysqli_query($this->conn, $sql)) {
            echo "Row deleted successfully.";
        } else {
            echo "Error deleting row: " . mysqli_error($this->conn);
        }
    }

    public function deteleMovie($movieID)
    {
        $sql = "DELETE FROM movie WHERE movieID = '$movieID'";
        
        if (mysqli_query($this->conn, $sql)) {
            echo "Row deleted successfully.";
        } else {
            echo "Error deleting row: " . mysqli_error($this->conn);
        }
    }

    public function deletebranchID($branchID)
    {
        $sql = "DELETE FROM branch WHERE branchID = '$branchID'";
        
        if (mysqli_query($this->conn, $sql)) {
            echo "Row deleted successfully.";
        } else {
            echo "Error deleting row: " . mysqli_error($this->conn);
        }
    }

    public function getContactDetails()
    {
        $check_query = "SELECT * FROM branch";
        $result = mysqli_query($this->conn, $check_query);
    
        $branch = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $branch[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
    
        return $branch;
    }


    public function uploadBranch($branchName,$address,$phoneNumber) 
    {

        $check_query = "SELECT * FROM branch";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows

        $sql = "INSERT INTO branch (branchName , address, phoneNumber) 
        VALUES ('$branchName', '$address', '$phoneNumber')";
        mysqli_query($this->conn,$sql);//connect to database for checking the output
        header("location:admin_branch_details.php");

    }

    public function deletepackageID($packageID)
    {
        $sql = "DELETE FROM package WHERE packageID = '$packageID'";
        
        if (mysqli_query($this->conn, $sql)) {
            echo "Row deleted successfully.";
        } else {
            echo "Error deleting row: " . mysqli_error($this->conn);
        }
    }

    public function updatePackageAdmin($packageID,$packageName, $packageDetail, $keyword) 
    {
        $check_query = "SELECT * FROM package WHERE packageID ='$packageID'";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows

        if ($check_result == 1) 
        {
            $sql = "UPDATE package SET packageName = '$packageName', packageDetail = '$packageDetail', keyword = '$keyword' WHERE packageID = '$packageID' ";
            if (mysqli_query($this->conn, $sql)) 
            {
                echo "Changes saved successfully.";
                header("location:admin_package_details.php");
            } else {
                echo "Error updating data: " . mysqli_error($this->conn);
            }
        } else {
            die("Unable to save changes.");
        }
    }

    public function uploadPacket($packageName, $packageDetail, $keyword) 
    {

        $check_query = "SELECT * FROM package";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows

        $sql = "INSERT INTO package (packageName , packageDetail, keyword) 
        VALUES ('$packageName', '$packageDetail', '$keyword')";
        mysqli_query($this->conn,$sql);//connect to database for checking the output
        header("location:admin_package_details.php");

    }

    public function deteleProduct($productID)
    {
        $sql = "DELETE FROM product WHERE productID = '$productID'";
        
        if (mysqli_query($this->conn, $sql)) {
            echo "Row deleted successfully.";
        } else {
            echo "Error deleting row: " . mysqli_error($this->conn);
        }
    }

    public function getProductDetail($productID)
    {
        $check_query = "SELECT * FROM product WHERE productID='$productID'";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "No product found with ID: " . $productID;
            return null;
        }
    }

    public function deleteTimeSlot($packageID,$movieID,$branchID,$dateOfmovie,$timeOfmovie)
    {
        $sql = "DELETE FROM package_movie WHERE packageID = '$packageID' AND movieID = '$movieID' AND branchID = '$branchID' AND dateOfmovie = '$dateOfmovie' AND timeOfmovie = '$timeOfmovie'";
        
        if (mysqli_query($this->conn, $sql)) {
            echo "Row deleted successfully.";
        } else {
            echo "Error deleting row: " . mysqli_error($this->conn);
        }
    }


    public function getMovieTimeSlotDetail($packageID,$movieID,$branchID,$dateOfmovie,$timeOfmovie)
    {
        $check_query = "SELECT * FROM package_movie WHERE packageID = '$packageID' AND movieID = '$movieID' AND branchID = '$branchID' AND dateOfmovie = '$dateOfmovie' AND timeOfmovie = '$timeOfmovie' ";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            // If the query returned a result with at least one row
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            // If the query did not return any results
            echo "No package found !" . $packageID;
            return null;
        }
    }


    public function displayPackageDetail()
    {
        $check_query = "SELECT * 
        FROM package";
        $result = mysqli_query($this->conn, $check_query);
    
        $Movie = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Movie[] = $row; 
            }
        } else {
            echo "Error executing query: " . mysqli_error($this->conn);
        }
        return $Movie;
    }    


    public function uploadMovieepurchas($movieID,$branchID,$dateOfmovie) 
    {

        $check_query = "SELECT * FROM moviepurchase WHERE movieID ='$movieID' AND branchID='$branchID' AND dateOfmovie='$dateOfmovie' ";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows

        if ($check_result == 0) {
            $sql = "INSERT INTO moviepurchase (movieID , branchID, dateOfmovie)
            VALUES ('$movieID', '$branchID', '$dateOfmovie')";
            mysqli_query($this->conn,$sql);//connect to database for checking the output
        }
        else
        {
            return false;
        } 
    }

    public function addPackage_movie($packageID,$movieID,$branchID,$dateOfmovie,$timeOfmovie) 
    {

        $check_query = "SELECT * FROM package_movie where movieID ='$movieID' AND branchID='$branchID' AND dateOfmovie='$dateOfmovie' AND packageID ='$packageID' AND timeOfmovie='$timeOfmovie'";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows
        if ($check_result ==0) 
        {
            $sql = "INSERT INTO package_movie (packageID , movieID, branchID, dateOfmovie, timeOfmovie)
            VALUES ('$packageID', '$movieID', '$branchID','$dateOfmovie','$timeOfmovie')";
            mysqli_query($this->conn,$sql);//connect to database for checking the output
            header("location: admin_movieTimeSlot_details.php");
            return true;
        }
        else
        {
            echo "<script>
            alert('The movie time had been choose!');
            window.location.href = 'addTimeSlot.php';
            </script>"; //header to the navigation page with the reminder  
        }
    }

    public function uploadRoom($Room, $dateOfmovie, $timeOfmovie, $branchID, $packageID, $movieID) 
    {
        $timeQuery = "SELECT * FROM package_movie WHERE Room ='$Room' AND branchID='$branchID' AND dateOfmovie='$dateOfmovie'";
        $timeResult = mysqli_query($this->conn, $timeQuery);
        $previousTimes = array(); // array to store previous times
    
        while ($row = mysqli_fetch_assoc($timeResult)) {
            $previousTime = $row['timeOfmovie'];
            $previousTimes[] = $previousTime; // store previous time in the array
        }
    
        $proposedTime = strtotime($timeOfmovie); // convert proposed time to a Unix timestamp
    
        // Check if the proposed time is within 3 hours of any previous time
        foreach ($previousTimes as $previous) {
            $previousUnixTime = strtotime($previous); // convert previous time to a Unix timestamp
            $timeDiff = abs($proposedTime - $previousUnixTime) / (60 * 60); // calculate absolute time difference in hours
    
            if ($timeDiff < 3) {
                echo "<script>
                        alert('The time difference between movie slots should be at least three hours!');
                        window.location.href = 'addTimeSlot.php';
                    </script>";
                return false;
            }
        }
    
        $sql = "INSERT INTO package_movie (packageID, movieID, branchID, dateOfmovie, timeOfmovie, Room)
                VALUES ('$packageID', '$movieID', '$branchID', '$dateOfmovie', '$timeOfmovie', '$Room')";
        mysqli_query($this->conn, $sql);
        echo "<script>
                alert('Successfully registered');
                window.location.href = 'admin_movieTimeSlot_details.php';
            </script>";
        return true;
    }
    
    public function updatePackage_movie($TimeSlotID,$packageID,$movieID,$branchID,$dateOfmovie,$timeOfmovie,$packageID1, $movieID1, $branchID1, $dateOfmovie1, $timeOfmovie1) 
    {
        $check_query = "SELECT * FROM package_movie WHERE TimeSlotID ='$TimeSlotID' ";
        $result = mysqli_query($this->conn,$check_query); //connect to data base for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows

        if ($check_result == 1) 
        {
            $check_query = "SELECT * FROM package_movie where movieID ='$movieID' AND branchID='$branchID' AND dateOfmovie='$dateOfmovie' AND packageID ='$packageID' AND timeOfmovie='$timeOfmovie'";
            $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
            $row = mysqli_num_rows($result);//check the number of rows
            if($row==0)
            {
                $sql = "UPDATE package_movie 
                SET  packageID = '$packageID', movieID = '$movieID', branchID = '$branchID', dateOfmovie = '$dateOfmovie', timeOfmovie = '$timeOfmovie' 
                WHERE TimeSlotID = '$TimeSlotID'";

                if (mysqli_query($this->conn, $sql)) 
                {
                    $this->uploadSeat($dateOfmovie, $movieID, $branchID, $packageID, $timeOfmovie, $packageID1, $movieID1, $branchID1, $dateOfmovie1, $timeOfmovie1);           
                    return true;

                } else {
                    echo "Error updating data: " . mysqli_error($this->conn);
                }
            }
            else
            {
                echo "<script>
                alert('The movie time had been choose!');
                window.location.href = 'admin_movieTimeSlot_details_edit.php';
                </script>"; //header to the navigation page with the reminder  
            }
        } 
        else {
            echo "successfully changed!!!!.";
            echo "<script>
            alert('The movie time had been choose!');
            window.location.href = 'admin_movieTimeSlot_details_edit.php';
            </script>"; //header to the navigation page with the reminder  
        }
    }
  
    public function updateRoom1($TimeSlotID, $Room, $dateOfmovie, $timeOfmovie, $branchID) 
    {
        $check_query = "SELECT * FROM package_movie WHERE TimeSlotID ='$TimeSlotID' ";
        $result = mysqli_query($this->conn, $check_query);
        $check_result = mysqli_num_rows($result);
    
        if ($check_result == 1) 
        {
            $timeQuery = "SELECT * FROM package_movie WHERE Room ='$Room' AND branchID='$branchID' AND dateOfmovie='$dateOfmovie'";
            $timeResult = mysqli_query($this->conn, $timeQuery);
            $previousTimes = array(); // array to store previous times
    
            while ($row = mysqli_fetch_assoc($timeResult)) {
                $previousTime = $row['timeOfmovie'];
                $previousTimes[] = $previousTime; // store previous time in the array
            }
    
            $proposedTime = strtotime($timeOfmovie); // convert proposed time to a Unix timestamp
    
            // Check if the proposed time is within 3 hours of any previous time
            foreach ($previousTimes as $previous) {
                $previousUnixTime = strtotime($previous); // convert previous time to a Unix timestamp
                $timeDiff = abs($proposedTime - $previousUnixTime) / (60 * 60); // calculate absolute time difference in hours
    
                if ($timeDiff < 3) {
                    echo "<script>
                            alert('The time difference between movie slots should be at least three hours!');
                            window.location.href = 'admin_movieTimeSlot_details_edit.php';
                        </script>";
                    return false;
                }
            }
    
            // If all conditions are met, update the room
            $sql = "UPDATE package_movie 
                    SET Room = '$Room' 
                    WHERE TimeSlotID = '$TimeSlotID'";
            mysqli_query($this->conn, $sql);
            return true;
        }
        else 
        {
            echo "TimeSlotID not found!";
        }
    }
    
    public function uploadSeat($date, $movieID, $branch, $packageID, $movieOftime, $packageID1, $movieID1, $branchID1, $dateOfmovie1, $timeOfmovie1) 
    {
       $check_query = "SELECT * FROM bookingfilm WHERE movieOfdate = '$dateOfmovie1' AND movieID = '$movieID1' AND branch = '$branchID1' AND packageID = '$packageID1' AND movieOftime = '$timeOfmovie1'";
       $result = mysqli_query($this->conn, $check_query);
       $check_result = mysqli_num_rows($result);

          $sql = "UPDATE bookingfilm 
                  SET movieOfdate = '$date', movieID = '$movieID', branch = '$branch', packageID = '$packageID', movieOftime = '$movieOftime'
                  WHERE movieID = '$movieID1' AND branch = '$branchID1' AND movieOfdate = '$dateOfmovie1' AND packageID = '$packageID1' AND movieOftime = '$timeOfmovie1'";
          mysqli_query($this->conn, $sql);


             
    }
    public function getBookingFileEmail($date, $movieID, $branch, $packageID, $movieOftime)
    {
        $convertedTime = date('H:i', strtotime($movieOftime));
        $check_query = "SELECT u.email FROM bookingfilm b
                        INNER JOIN user u ON b.userID = u.user_id
                        WHERE b.movieOfdate = '$date' AND b.movieID = '$movieID'
                        AND b.branch = '$branch' AND b.packageID = '$packageID'
                        AND b.movieOftime = '$convertedTime'
                        GROUP BY u.email";
    
        $result = mysqli_query($this->conn, $check_query);
    
        if (!$result) {
            echo "Error executing query: " . mysqli_error($this->conn);
            return [];
        }
    
        $occupiedSeats = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $occupiedSeats[] = $row["email"];
        }
    
        return $occupiedSeats;
    }
    
    public function showPopcorn1()
    {
        $check_query = "SELECT * FROM product LIMIT 0, 1";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "No products found.";
        }
    }
    public function showPopcorn2()
    {
        $check_query = "SELECT * FROM product LIMIT 1, 2";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "No products found.";
        }
    }
    public function showPopcorn3()
    {
        $check_query = "SELECT * FROM product LIMIT 2, 3";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "No products found.";
        }
    }

    public function showPopcorn4()
    {
        $check_query = "SELECT * FROM product LIMIT 3, 4";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "No products found.";
        }
    }
    public function showPopcorn5()
    {
        $check_query = "SELECT * FROM product LIMIT 4, 5";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "No products found.";
        }
    }
    public function showPopcorn6()
    {
        $check_query = "SELECT * FROM product LIMIT 5, 6";
        $result = mysqli_query($this->conn, $check_query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "No products found.";
        }
    }

    public function deleteSeat($movieOfdate,$movieID,$seatID,$branch,$packageID,$movieOftime)
    {
        $sql = "DELETE FROM bookingfilm WHERE movieOfdate = '$movieOfdate' AND movieID = '$movieID' AND seatID = '$seatID' AND branch = '$branch' AND packageID = '$packageID' AND movieOftime = '$movieOftime'";
        
        if (mysqli_query($this->conn, $sql)) {
            echo "Row deleted successfully.";
        } else {
            echo "Error deleting seat!" . mysqli_error($this->conn);
        }
    }


    
}



class email{
    //generate a random verify
    function sendChangeTimeSlot($email, $previousDate, $previousTimeSlot, $newDate, $newTimeSlot) 
    {
        $to = $email;
        $subject = "Movie Time Slot Changed";
        $message = "Hello,\n\nWe would like to inform you that the movie time slot for your booking has been changed.\n\nPrevious Date: $previousDate\nPrevious Time Slot: $previousTimeSlot\nNew Date: $newDate\nNew Time Slot: $newTimeSlot\n\nIf you have any questions or concerns, please feel free to contact us.\n\nThank you.";
        $headers = "From: phptesting00@gmail.com";
    
        mail($to, $subject, $message, $headers);
    }
    
    public function sendBill($email, $dateOfmovie, $timeOfmovie, $totalPrice, $seatNumber,$movieName)
    {
        $to = $email;
        $subject = "Bill completed";
        $message = "Dear Customer,\n\n";
        $message .= "This is to inform you that the movie time slot for your booking has been changed. Please see the details below:\n";
        $message .= "Movie name: $movieName\n";
        $message .= "Date: $dateOfmovie\n";
        $message .= "Time: $timeOfmovie\n";
        $message .= "Total Price: $totalPrice\n";
        $message .= "Seat Number(s): $seatNumber\n";
        $message .= "\nThank you for choosing our services.\n";
        $message .= "Best regards,\nYour Movie Theater";
        $headers = "From: phptesting00@gmail.com";
        // Send the email
        mail($to, $subject, $message, $headers);
    }


    function sendUpdatedUserDetailsEmail($recipientEmail, $updatedFullName, $updatedEmailAddress, $updatedPhoneNumber)
    {
        $subject = "Updated User Details Notification";
        
        $message = "Dear User,\n\n";
        $message .= "We wanted to inform you that some of your details have been updated in our system. Please review the updated information below:\n\n";
        $message .= "Full Name: " . $updatedFullName . "\n";
        $message .= "Email Address: " . $updatedEmailAddress . "\n";
        $message .= "Phone Number: " . $updatedPhoneNumber . "\n";
        $message .= "If you did not make any changes to your details or if you believe this is an error, please contact our customer support team immediately.\n\n";
        $message .= "Best regards,\nYour Company Name";
        $headers = "From: phptesting00@gmail.com";
        // Send the email
        mail($recipientEmail, $subject, $message, $headers);
    }
    
    function sendCancellationEmail($recipientEmail, $movieName, $date, $time, $seatNumber, $refundAmount)
    {
        $subject = "Ticket Cancellation Notification";
        
        $message = "Dear User,\n\n";
        $message .= "We regret to inform you that your ticket for the movie '$movieName' on $date at $time has been cancelled.\n";
        $message .= "Seat Number(s): $seatNumber\n";
        $message .= "Refund Amount: RM $refundAmount\n\n";
        $message .= "We apologize for any inconvenience caused. The refunded amount will be credited back to your original payment method within 3-5 business days.\n";
        $message .= "If you have any questions or need further assistance, please contact our customer support team.\n\n";
        $message .= "Best regards,\nCinema";
    
        $headers = "From: phptesting00@gmail.com";
        
        // Send the email
        mail($recipientEmail, $subject, $message, $headers);
    }



    }