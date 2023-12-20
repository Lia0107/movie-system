<?php
class Login {
    private $conn;
    public function __construct($server, $username, $password, $database) // Constructor method
	{
        $this->conn = new mysqli($server, $username, $password, $database); //connect to the database
        if (!$this->conn) { // if connect fail 
            die("Connect failed: " .$this->conn.mysqli_connect_error()); 
        }
    }


    public function uploadTicket($date, $movieID, $seatID,$branch,$packageID,$movieOftime) 
    {

        $check_query = "SELECT * FROM bookingfilm WHERE movieOfdate ='$date' AND movieID='$movieID' AND branch='$branch' AND seatID='$seatID' AND packageID='$packageID' AND movieOftime='$movieOftime'";
        $result = mysqli_query($this->conn,$check_query); //connect to database for checking and getting the output
        $check_result = mysqli_num_rows($result);//check the number of rows

        if ($check_result == 0) {
            $sql = "INSERT INTO bookingfilm (movieOfdate , movieID, seatID, branch, packageID, movieOftime) 
            VALUES ('$date', '$movieID', '$seatID','$branch','$packageID','$movieOftime')";
            mysqli_query($this->conn,$sql);//connect to database for checking the output



        }
        else
        {
            Die("The seat has been select!!");
        } 

    }
    public function isOccupied($date, $movieID,$branch,$packageID,$movieOftime)
    {
        $check_query = "SELECT * FROM bookingfilm WHERE movieOfdate ='$date' AND movieID='$movieID' AND branch='$branch' AND packageID='$packageID' AND movieOftime='$movieOftime'";
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
        $check_query = "SELECT * FROM Movie WHERE status != '' ORDER BY movieID asc";
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
            echo "No movie found with ID: " . $movieID;
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

    public function findMovie($keywork)
    {
        $check_query = "SELECT * FROM Movie WHERE movieName like '%$keywork%'";
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

        $check_query = "SELECT  TIME_FORMAT(timeOfmovie, '%h:%i %p') AS timeOfmovie,packageID,dateOfmovie
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
            session_start();
            $_SESSION["paymentID"] = $paymentID;
        }
        else
        {
            Die("The Pickture has been updated!!");
        } 

    }

    public function getQr($paymentID)
    {
        $check_query = "SELECT * FROM bill WHERE paymentID = '$paymentID'";
        $result = mysqli_query($this->conn, $check_query);
        $row = mysqli_fetch_assoc($result);
    
        return $row;
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
    
}