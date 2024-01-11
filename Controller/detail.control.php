<?php
include "./Controller/main.controller.php";

class view extends main
{
    protected $id;
    protected $booked=false;

    function __construct()
    {
        parent::__construct();
    }
    function gettourdata()
    {
        if(isset($_GET['tourid']))
        {
           $this->id=$_GET['tourid'];
          
        }
        
        return $this->id;
    }
    function checktour()
    {
        
        
        if(isset($_SESSION['user']))
        {
            
            $usertravel=NULL;
            $stmt=$this->conn->prepare("SELECT guest_travel_plan FROM guest WHERE guest_name=:name1");
    
           
            $stmt->bindparam(":name1",$_SESSION['user']);
            $stmt->execute();
    
            if($stmt->rowCount()>0)
            {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
                while($row=$stmt->fetch())
                {
                   
                    $usertravel=$row['guest_travel_plan'];
                    
                  
                }
            }
            if($usertravel!=null || $usertravel!="")
            {
                $usertravelarr=explode(",",$usertravel);
                foreach($usertravelarr as $travel)
                {
                    if($travel==$this->id)
                    {
                        $this->booked=true;
                    }
                }
            }
            

    
           
        }
        return $this->booked;
    }

    function gettour() : array
    {
        $tour=[];
        $stmt=$this->conn->prepare("SELECT * FROM tour_plan WHERE tour_id=:id");

       
        $stmt->bindparam(":id",$this->id);
        $stmt->execute();

        if($stmt->rowCount()>0)
        {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while($row=$stmt->fetch())
            {
                $tour_id=$row['tour_id'];
                $tour_dest=$row['tour_destination'];
                $tour_package=$row['tour_package'];
                $tour_image=$row['tour_image'];
                $tour_ppl_max=$row['tour_ppl_max_amount'];
                $tour_ppl_registered=$row['tour_ppl_registered_amount'];
                $tour_start_date=$row['tour_start_date'];
                $tour_price=$row['tour_price'];
                $tour_description=$row['tour_description'];
                $tour[]=$tour_id;
                $tour[]=$tour_dest;
                $tour[]=$tour_package;
                $tour[]=$tour_image;
                $tour[]=$tour_ppl_max;
                $tour[]=$tour_ppl_registered;
                $tour[]=$tour_start_date;
                $tour[]=$tour_price;
                $tour[]=$tour_description;
            }
        }

        return $tour;
    }
    
    function getid()
    {
        return $this->id;
    }
}



$v=new view();
$tourid = $v->gettourdata(); 
$tour=$v->gettour();
$booked=$v->checktour(); 

