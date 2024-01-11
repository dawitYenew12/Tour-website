<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./staticfiles/header.css">
    <link rel="stylesheet" href="./staticfiles/mytrip.css">
    <title>Document</title>
</head>

<body>
    <?php include './header.php';



    include './Controller/mytrip.control.php';
    ?>

    <div class="fullinfo">
        <div class="userinfocontainer">

            <?php if (isset($_GET['edit'])) {
                echo
                "
                <p class='pimg'><img src='user.png' alt=''></p>
                <p class='edit'><a href=" . "./mytrip.php?user=" . $user[1] . "><i class='fa-solid fa-arrow-left'></a></i></p>
            <form action='./Controller/mytrip.control.php?user=" . $user[1] . " method='post' class='innercontainer-edit'>
            <div class='user-name'>
                    <p class='label'>Name</p>
                <p> <input type='text' name='username' value=" . $user[1] . "></p>
                </div>
                <div class='email'>
                <p class='label'>Email</p>
                <p> <input type='email' name='email' value=" . $user[2] . "></p>
                </div>
                <div class='phone'>
                <p class='label'>Phone</p>
                <p> <input type='text' name='phone' value=" . $user[3] . "></p>
                    <br>
                <p> <input type='submit' name='submit' value='Edit'>
                </form>

                ";
            } else {
                echo
                "
                <p class='pimg'><img src='user.png' alt=''></p>

                <p class='edit'><a href= " . "./mytrip.php?user=" . $user[1] . "&edit=on" . "><i class='fa-solid fa-pen-to-square'></i></a></p>
            <div class='innercontainer'>   

                <div class='user-name'>
                    <p class='label'>Name</p>
                <p class='data'>" . $user[1] . "</p>
                </div>
                <div class='email'>
                <p class='label'>Email</p>
                <p class='data'>" . $user[2] . "</p>
                </div>
                <div class='phone'>
                <p class='label'>Phone</p>
                <p class='data'>" . $user[3] . "</p>
                </div>

            </div>
            
                ";
            }
            ?>
        </div>


<!-- cancel trip -->
    </div>


    <script src="./staticfiles/header.js"></script>
    <script src="./staticfiles/mytrip.js"></script>
</body>

</html>