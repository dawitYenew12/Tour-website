<?php
include "./main.controller.php";
class search extends main
{

    function __construct()
    {
        parent::__construct();
    }




    function getalltourplans()
    {

        $all = [];

        $query = "SELECT * FROM tour_plan";
        $result = $this->conn->query($query);

        while ($row = $result->fetch()) {
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

        echo json_encode($all);
    }
}

$s = new search();
$s->getalltourplans();

?>