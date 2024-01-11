<?php

include "./main.controller.php";

class book extends main
{
    protected $id;
    protected $user;
    function __construct()
    {
        parent::__construct();
    }

    function getid()
    {
        if (isset($_GET['bookid']) && isset($_GET['user'])) {
            $this->user = $_GET['user'];
            $this->id = $_GET['bookid'];
            $this->booktour();
        } else if (isset($_GET['unbookid']) && isset($_GET['user'])) {
            $this->user = $_GET['user'];
            $this->id = $_GET['unbookid'];
            $this->unbooktour();
        }
    }

    function gettour()
    {
        $tour = [];
        $stmt = $this->conn->prepare("SELECT * FROM tour_plan WHERE tour_id=:id");


        $stmt->bindparam(":id", $this->id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while ($row = $stmt->fetch()) {
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
            }
        }
        return $tour;
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
    function booktour()
    {
        $tour = $this->gettour();
        $userinfo = $this->getuser();

        if ($tour[5] < $tour[4]) {
            $this->updatetourregister($tour);
            $this->updateuserplan($userinfo, $tour);
            echo "success";
        } else {
            echo "No Place Availble";
        }
    }
    function unbooktour()
    {
        $tour = $this->gettour();
        $userinfo = $this->getuser();
        $this->deletetourregister($tour);
        $this->deleteuserplan($userinfo, $tour);
        echo "success";
    }

    function updatetourregister($tour)
    {
        $amount = $tour[5] + 1;
        $stmt = $this->conn->prepare("UPDATE  tour_plan  
        SET tour_ppl_registered_amount=:amount
            WHERE tour_id=:t");
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':t', $tour[0]);


        $stmt->execute();
    }
    function deletetourregister($tour)
    {
        $amount = $tour[5] - 1;
        $stmt = $this->conn->prepare("UPDATE  tour_plan  
        SET tour_ppl_registered_amount=:amount
            WHERE tour_id=:t");
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':t', $tour[0]);


        $stmt->execute();
    }
    function updateuserplan($userinfo)
    {
        $plan = $userinfo[4];
        $found = false;

        if ($plan == null || $plan = "") {
            $plan = (string)$this->id . ",";
        } else {
            $pplan = explode(",", $userinfo[5]);
            foreach ($pplan as $p) {
                if ($p == $this->id) {
                    $found = true;
                }
            }
            if ($found == false) {
                $plan .= (string)$this->id . ",";
            }
        }

        $stmt = $this->conn->prepare("UPDATE  guest  
        SET guest_travel_plan=:p
            WHERE guest_name=:t");
        $stmt->bindParam(':p', $plan);
        $stmt->bindParam(':t', $this->user);


        $stmt->execute();
    }
    function deleteuserplan($userinfo)
    {
        $plan = explode(",", $userinfo[4]);
        $newplan = "";
        if ($plan != []) {
            foreach ($plan as $p) {
                if ($p != $this->id) {
                    $newplan .= $p . ",";
                }
            }
        }




        $stmt = $this->conn->prepare("UPDATE  guest  
        SET guest_travel_plan=:p
            WHERE guest_name=:t");
        $stmt->bindParam(':p', $newplan);
        $stmt->bindParam(':t', $this->user);


        $stmt->execute();
    }
}

$b = new book();
$b->getid();