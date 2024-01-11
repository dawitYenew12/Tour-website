<?php

include "./main.controller.php";

class signup extends main
{
    public $name;
    public $email;
    public $phone;
    public $password;
    public $cpassword;



    function getpostdata()
    {
        if (isset($_POST['submit'])) {
            $this->name = $_POST['name'];
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];
            $this->cpassword = $_POST['cpassword'];
            $this->phone = $_POST['number'];
            return true;
        } else {

            header("Location:  ../sample.php");

            exit;
        }
    }

    function checkname()
    {
        if (empty($this->name)) {

            header("location: ../sample.php?error=name");
        }

        return true;
    }
    function checkemail()
    {
        if (empty($this->email) || (!filter_var($this->email, FILTER_VALIDATE_EMAIL))) {

            header("location: ../sample.php?error=email");
        } else return true;
    }
    function checkpassword()
    {
        if (empty($this->password) || $this->password !== $this->cpassword) {

            header("location:../sample.php?error=password");
        } else return true;
    }
    function checkphone()
    {
        if (empty($this->phone) || strlen($this->phone) !== 10) {

            header("location: ../sample.php?error=phone");
        } else return true;
    }

    function confirmsignup()
    {
        if ($this->checkname() === true && $this->checkpassword() === true && $this->checkemail() === true && $this->checkphone() === true) {
            return true;
        } else return false;
    }

    function registertoDB()
    {



        $hashed_password = md5($this->password);

        $stmt = $this->conn->prepare("INSERT INTO guest (guest_name,guest_email,guest_password,guest_phone)
                    VALUES (:fname,:femail,:fpassword,:fphone)");
        $stmt->bindParam(':fname', $this->name);
        $stmt->bindParam(':femail', $this->email);
        $stmt->bindParam(':fpassword', $hashed_password);
        $stmt->bindParam(':fphone', $this->phone);

        $stmt->execute();
    }
}

error_log(json_encode($_POST));

//initalize signupclass
$guest = new signup();
error_log("submitting");

if ($guest->getpostdata()) {
    error_log("submitting " . json_encode($guest->getpostdata()) . " " . $guest->confirmsignup());
    if ($guest->confirmsignup() === true) {

        $guest->registertoDB();
        header("location: ../sample.php?error=success");
    }
}
