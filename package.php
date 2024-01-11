<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./staticfiles/header.css">
    <link rel="stylesheet" href="./staticfiles/package.css">
    <title>Document</title>
</head>

<body>
    <?php include './header.php'; ?>
    <?php
    include 'Controller/package.control.php'; ?>


    <div class="packages-page">

        <div class="inspiration">

            <h1>
                Choose A Plan That's Right For You
            </h1>


        </div>
        <div class="package-options">
            <div class="package-option">
                <h2>Day</h2>

                <div class="priceplandiv">
                    <sup>$</sup>
                    <span class="priceplan">0</span>
                    <span>-</span>
                    <sup>$</sup>
                    <span class="priceplan">40</span>
                </div>


                <button class="package-start">
                    <a href="./package.php?package=day">
                        Look at Package
                    </a>
                </button>
        </div>
            <div class="package-option">
                <h2>Weekly</h2>

                <div class="priceplandiv">
                    <sup>$</sup>
                    <span class="priceplan">50</span>
                    <span>-</span>
                    <sup>$</sup>
                    <span class="priceplan">100</span>
                </div>


                <button class="package-start">
                    <a href=" ./package.php?package=week">
                        Look at Package
                    </a></button>


            </div>
            <div class="package-option">
                <h2>Monthly</h2>

                <div class="priceplandiv">
                    <sup>$</sup>
                    <span class="priceplan">100</span>
                    <span>-</span>

                    <span class="priceplan">Above</span>
                </div>


                <button class="package-start">
                    <a href=" ./package.php?package=month">
                        Look at Package
                    </a>
                </button>
            </div>

        </div>
        <div class="packagecontainer">
            <?php
            if($PackType !== null){

                if ($allpack !== []) {
                    foreach ($allpack as $pack) {
                        echo
                        "
                            <div class='package'>
                                <img src=" . $pack[3] . " alt=''>
                                <div class='packageinfo'>
                                    <h3>
                                        " . $pack[1] . "
                                    </h3>
                                    <div class='tour-price-div'>
                                        <sup>$</sup>
                                        <span class='tour-price'>
                                            " . $pack[7] . "
                                        </span>
                                        </div>
                                </div>
                                <button class='detail'>
                                    <a href='./detail.php?tourid=" . $pack[0] . "' >  
                                        View Details
                                    </a>  
                                </button>
                            </div>
             ";
                    }
                } else {
                    echo
                    "
                    <div class='nopackage'>
                        <div class='nopackagefound'>
                            <h1>No Package of this Category <br> at the Moment</h1>
                            <p>Please check out the other packages</p>
                            </div>
                            </div>
                            ";
                        }
                    }
            ?>

        </div>


        <script src="./staticfiles/header.js"></script>
</body>

</html>