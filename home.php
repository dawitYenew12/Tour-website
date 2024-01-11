<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="./staticfiles/home.css">
    <link rel="stylesheet" href="./staticfiles/header.css">
    <title>Document</title>
</head>

<body>


    <?php include './header.php'; ?>

    <div class="parentdiv">


        <div class="content">
            <button class="enter">Start Your Travels</button>

            <div class="btns">
                <button class="btn1 btn">
                    <div class="dot dot1"></div>
                </button>
                <button class="btn2 btn">
                    <div class="dot dot2"></div>
                </button>
                <button class="btn3 btn">
                    <div class="dot dot3"></div>
                </button>
            </div>
        </div>
    </div>

    <div class="imgs">
        <img src="cover1.webp" alt="" class="cover1 cover">
        <img src="cover2.jpg" alt="" class="cover2 cover">
        <img src="cover3.jpg" alt="" class="cover3 cover">
    </div>

    <script src="./staticfiles/header.js"></script>
    <script src="./staticfiles/home.js"></script>
</body>

</html>