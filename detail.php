<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./staticfiles/header.css">
    <link rel="stylesheet" href="./staticfiles/detail.css">
    <title>Document</title>
</head>
<body>
<?php include './header.php';?>
<?php include './Controller/detail.control.php'; ?>



<div class="view">
<div class="viewcontainer">
    <input type="hidden" name="tourid" value="<?= $tourid ?>">
    
    <?php 
  
    
    if($tour!=[] && $booked==false)
    {
        echo "
            <div class='img-view'>
                <img src=".$tour[3]." alt=''>
            </div>

            <div class='info-view'>
                <h1> <i> " .$tour[1]  ."</i> </h1>
                <p>".$tour[8]."</p>

        <div class='datediv'>
            <span class='datetitle'>Date:</span>
            <span class='date'>".$tour[6]."</span>
        </div>

        <div class='bookinfo'>
            <span class='price'>$".$tour[7]."</span>
            <button class='book'>
                Book Now
            </button>
        </div>
    </div>

</div>
";
    }
    if($tour!=[] && $booked==true)
    {
        echo "
    <div class='img-view'>
        <img src=".$tour[3]." alt=''>
    </div>
    <div class='info-view'>
        <h1> <i> " .$tour[1]  ."</i> </h1>
        <p>".$tour[8]."</p>

        <div class='datediv'>
            <span class='datetitle'>Date:</span>
            <span class='date'>".$tour[6]."</span>
        </div>

        <div class='bookinfo'>
            <span class='price'>$".$tour[7]."</span>
            <button class='book'>
                Unbook
            </button>
        </div>
    </div>

</div>
";

    }
?>

</div>

</div>


<script src="./staticfiles/header.js"></script>
<script src="./staticfiles/detail.js"></script>
</body>
</html>