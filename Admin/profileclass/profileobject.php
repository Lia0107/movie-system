<?php
class profileobject {
    private $fname;
    private $lname;
    private $phoneNo;
    private $email;
    private $gender;

    public function __construct($fname, $lname, $phoneNo, $email, $gender) {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->phoneNo = $phoneNo;
        $this->email = $email;
        $this->gender = $gender;
    }

    public function Errorfname() {
        $error = $this->fname;
        if (!empty($error)) {
            if (!preg_match("/^[A-Za-z]+$/", $this->fname)) {
                $error = "Only alphabets are allowed!";
            } else {
                $error = ""; // If entered correctly, clear the value
            }
        } else {
            $error = "Fill in your First Name.";
        }
        return $error;
    }

    public function Errorlname() {
        $error = $this->lname;
        if (!empty($error)) {
            if (!preg_match("/^[A-Za-z]+$/", $this->lname)) {
                $error  = "Only alphabets are allowed!";
            } else {
                $error = ""; // If entered correctly, clear the value
            }
        } else {
            $error = "Fill in your Last Name.";
        }
        return $error;
    }

    public function Errorph() {
        $error = $this->phoneNo;
        if (!empty($error)) {
            if (!preg_match("/^([0-9]{9,10})$/", $this->phoneNo)) {
                $error  = "Only 9-10 numbers are allowed!";
            } else {
                $error = ""; // If entered correctly, clear the value
            }
        } else {
            $error = "Fill in phone number.";
        }
        return $error;
    }

    public function Errorm() {
        $error = $this->email;
        if (empty($error)) {
            $error= "Email is required!!.";
        } else if (!filter_var($error, FILTER_VALIDATE_EMAIL)) {
            return "Wrong email format!";
        } else {
            $error = "";
        }
        return $error;
    }

    public function Errorgen() {
        $gender = $this->gender;
        $error = "";
        if (empty($gender)) {
            $error = "Gender is required!";
        }
        return $error;
    }
}
?>