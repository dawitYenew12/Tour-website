<?php
include "./Controller/main.controller.php";


class package extends main
{

    public $packagetype;
    protected $packageelement = [];


    function __construct()
    {
        parent::__construct();
    }
    function getpackagedata()
    {
        if (isset($_GET['package'])) {
            $this->packagetype = $_GET['package'];
            $this->packageelement = $this->getpackages();
        }
    }

    function getpackages()
    {
        $all = [];

        $query = "SELECT * FROM tour_plan where tour_package=:package";

        $results = $this->conn->prepare($query);
        $results->bindparam(':package', $this->packagetype);
        $results->execute();

        if ($results->rowCount() > 0) {
            $results->setFetchMode(PDO::FETCH_ASSOC);

            while ($row = $results->fetch()) {
                $ar = [];
                $tour_id = $row['tour_id'];
                $tour_dest = $row['tour_destination'];
                $tour_package = $row['tour_package'];
                $tour_image = $row['tour_image'];
                $tour_ppl_max = $row['tour_ppl_max_amount'];
                $tour_ppl_registered = $row['tour_ppl_registered_amount'];
                $tour_start_date = $row['tour_start_date'];
                $tour_price = $row['tour_price'];
                $tour_description = $row['tour_description'];
                $ar[] = $tour_id;
                $ar[] = $tour_dest;
                $ar[] = $tour_package;
                $ar[] = $tour_image;
                $ar[] = $tour_ppl_max;
                $ar[] = $tour_ppl_registered;
                $ar[] = $tour_start_date;
                $ar[] = $tour_price;
                $ar[] = $tour_description;


                $all[] = $ar;
            }
        }
        return $all;
    }

    function packageType(){
        return $this->packagetype;
    }
}

// error_log(json_encode($_POST));
$pack = new package();

$pack->getpackagedata();
$allpack = $pack->getpackages();
$PackType = $pack->packageType();
