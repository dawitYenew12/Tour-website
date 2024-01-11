<?php
class main
{

    protected $conn;


    function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=tour", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            die();
        }
    }

    function getconnection()
    {
        return $this->conn;
    }

    function closeconnection()
    {
        $this->conn = null;
    }
}
class mytrip extends main
{
    public $tours;
    protected $user;
    protected $id = -1;
    protected $userinfotoupdate = [];
    function __construct()
    {
        parent::__construct();
    }

    function getdata()
    {
        if (isset($_GET['user']) && !isset($_GET['deleteid'])) {
            if (isset($_POST['submit']) && isset($_GET['user'])) {
                $this->user = $_GET['user'];
                $this->tours = $this->getusertours();
                $this->userinfotoupdate[] = $_POST['username'];
                $this->userinfotoupdate[] = $_POST['email'];
                $this->userinfotoupdate[] = $_POST['phone'];
                $this->updateuserinfo();
            } else {
                $this->user = $_GET['user'];
                $this->tours = $this->getusertours();
            }
        } else if (isset($_GET['deleteid']) && isset($_GET['user'])) {
            $this->user = $_GET['user'];
            $this->id = $_GET['deleteid'];
            $this->deletefromplan();
            $this->deletetourregister();
            $this->tours = $this->getusertours();

            //     header("Location: ./mytrip.php?user=".$this->user);
            // exit;
        }
    }
    function updateuserinfo()
    {

        $stmt = $this->conn->prepare("UPDATE  guest  
        SET guest_name=:n,
            guest_email=:e,
            guest_phone=:ph
            WHERE guest_name=:user");
        $stmt->bindParam(':n', $this->userinfotoupdate[0]);
        $stmt->bindParam(':e', $this->userinfotoupdate[1]);
        $stmt->bindParam(':ph', $this->userinfotoupdate[2]);
        $stmt->bindParam(':user', $this->user);


        $stmt->execute();
        $this->user = $this->userinfotoupdate[0];
        $this->tours = $this->getusertours();
        header("Location: ./mytrip.php?user=" . $this->user);
        exit;
    }

    function gettour()
    {
        $alltours = null;
        $result = $this->conn->query("SELECT * FROM tour_plan");


        while ($row = $result->fetch()) {
            $tour = [];
            $tour_id = $row['tour_id'];
            $tour_dest = $row['tour_destination'];
            $tour_package = $row['tour_package'];
            $tour_image = $row['tour_image'];
            $tour_ppl_max = $row['tour_ppl_max_amount'];
            $tour_ppl_registered = $row['tour_ppl_registered_amount'];
            $tour_start_date = $row['tour_start_date'];
            $tour_price = $row['tour_price'];
            $tour_description = $row['tour_description'];
            $tour[] = $tour_id;
            $tour[] = $tour_dest;
            $tour[] = $tour_package;
            $tour[] = $tour_image;
            $tour[] = $tour_ppl_max;
            $tour[] = $tour_ppl_registered;
            $tour[] = $tour_start_date;
            $tour[] = $tour_price;
            $tour[] = $tour_description;

            $alltours[] = $tour;
        }

        return $alltours;
    }
    function getuser()
    {
        $userinfo = [];
        $stmt = $this->conn->prepare("SELECT * FROM guest WHERE guest_name=:name1");


        $stmt->bindparam(":name1", $this->user);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while ($row = $stmt->fetch()) {
                $guest_id = $row['guest_id'];
                $guest_name = $row['guest_name'];
                $guest_email = $row['guest_email'];
                $guest_phone = $row['guest_phone'];
                $guest_travel_plan = $row['guest_travel_plan'];

                $userinfo[] = $guest_id;
                $userinfo[] = $guest_name;
                $userinfo[] = $guest_email;
                $userinfo[] = $guest_phone;
                $userinfo[] = $guest_travel_plan;
            }
        }

        return $userinfo;
    }


    function getusertours()
    {
        $alltours = $this->gettour();
        $usertours = explode(",", $this->getuser()[4]);

        $filteredtours = [];

        foreach ($alltours as $tour) {
            if (in_array($tour[0], $usertours)) {
                $filteredtours[] = $tour;
            }
        }

        return $filteredtours;
    }


    //cancel logic
}

$trip = new mytrip();
$trip->getdata();
$user = $trip->getuser();
$plans = $trip->tours;
