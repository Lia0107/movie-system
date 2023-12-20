<?php
class profileobject {
    private $fname;
    private $lname;
    private $phoneNo;
    private $email;
    private $gender;
    private $password;



    public function __construct($fname, $lname, $phoneNo, $email, $gender, $password) {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->phoneNo = $phoneNo;
        $this->email = $email;
        $this->gender = $gender;
        $this->password = $password;
    }

    public function Errorfname() {
        $error = $this->fname;
        if (!empty($error)) {
            if (!preg_match("/^[A-Za-z0-9.,\-]+$/", $this->fname)) {
                $error = "Only alphabets are allowed!";
            } else {
                $error = ""; // If entered correctly, clear the value
            }
        } else {
            $error = "Fill in the field.";
        }
        return $error;
    }

    public function Errorlname() {
        $error = $this->lname;
        if (!empty($error)) {
            if (!preg_match("/^[A-Za-z0-9.,\-]+$/", $this->lname)) {
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

    
    public function Errorpw() {
        $error = $this->password;
        if (empty($error)) {
            return "Fill in your password.";
        } else {
            if (strlen($error) < 8) {
                $error="Password should be more than 7 characters.";
            } 
            else if (strlen($error) <= 100) 
            {
                if (!preg_match("/^[a-zA-Z0-9]*$/", $this->password)) {
                    return "Only letters and numbers are allowed.";
                } else {
                    $error = "";
                }
            } else {
                $error = "Please fill in your password.";
            }
            return $error;
        }
    }

    public function ErrorField() {
        $error = $this->fname;
        if (!empty($error)) {
            if (!preg_match("/^[A-Za-z0-9 ]+$/", $this->fname)) {
                $error = "Only alphabets are allowed!";
            } else {
                $error = ""; // If entered correctly, clear the value
            }
        } else {
            $error = "Fill in the field.";
        }
        return $error;
    }

}


class packageVerification {
    private $packageName;
    private $packageDetail;
    private $keyword;



    public function __construct($packageName, $packageDetail, $keyword) {
        $this->packageName = $packageName;
        $this->packageDetail = $packageDetail;
        $this->keyword = $keyword;

    }


    public function ErrorField1() {
        $error = $this->packageName;
        if (!empty($error)) {
            if (!preg_match("/^[A-Za-z0-9.,\- ]+$/", $this->packageName)) {
                $error = "Only alphabets and number are allowed!";
            } else {
                $error = ""; // If entered correctly, clear the value
            }
        } else {
            $error = "Fill in the field.";
        }
        return $error;
    }

    public function ErrorField2() {
        $error = $this->packageDetail;
        if (!empty($error)) {
            if (!preg_match("/^[A-Za-z0-9!.,\- ]+$/", $this->packageDetail)) {
                $error = "Only alphabets and number are allowed!";
            } else {
                $error = ""; // If entered correctly, clear the value
            }
        } else {
            $error = "Fill in the field.";
        }
        return $error;
    }
    public function ErrorField3() {
        $error = $this->keyword;
        if (!empty($error)) {
            if (!preg_match("/^[A-Za-z0-9!.,\- ]+$/", $this->keyword)) {
                $error = "Only alphabets and number are allowed!";
            } else {
                $error = ""; // If entered correctly, clear the value
            }
        } else {
            $error = "Fill in the field.";
        }
        return $error;
    }

    public function ErrorField4() {
        $error = $this->packageDetail;
        if (!empty($error)) {
            if (!preg_match("/^[0-9.,\- ]+$/", $this->packageDetail)) {
                $error = "Only number are allowed!";
            } else {
                $error = ""; // If entered correctly, clear the value
            }
        } else {
            $error = "Fill in the field.";
        }
        return $error;
    }
}
?>