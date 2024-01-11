<?php

include "./main.controller.php";

class login extends main
{
    public $name;
    public $password;




    function getpostdata()
    {
        if (isset($_POST['submit'])) {
            $this->name = $_POST['username'];
            $this->password = $_POST['loginpassword'];

            return true;
        } else {
            header("Location:  ../package.php");

            exit;
        }
    }


    function checkusername()
    {

        if (empty($this->name)) {

            header("Location: ../package.php?loginerror=username");
            exit;
        }

        return true;
    }
    function checkpassword()
    {
        if (empty($this->password)) {

            header("Location:  ../package.php?loginerror=password");
            exit;
        } else {

            return true;
        }
    }

    function getuser()
    {

        if ($this->checkusername() === true && $this->checkpassword() === true) {


            $stmt = $this->conn->prepare("SELECT guest_name,guest_password FROM guest WHERE guest_email=:username");

            $name1 = $this->name;
            $stmt->bindparam(":username", $name1);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                while ($row = $stmt->fetch()) {
                    $user = $row['guest_name'];
                    $md5confirm = md5($this->password);

                    if ($row['guest_password'] == $md5confirm) {
                        header("Location:  ../package.php?username=$user");
                        exit;
                    } else {

                        header("Location: ../package.php?loginerror=password&&user=$user");
                        exit;
                    }
                }
            } else {
                header("Location: ../package.php?loginerror=username");
                exit;
            }
        }
    }
}

error_log(json_encode($_POST));
$user = new login();


if ($user->getpostdata()) {



    $user->getuser();
    header("location: ../package.php?error=success");
}
