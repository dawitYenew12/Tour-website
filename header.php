    <?php
    @session_start();

    if (isset($_GET['error']) && $_GET['error'] !== "success") {

        $message = $_GET['error'];

        echo " <div class='message'>
      $message
        </div>
        ";
    } else {
        $message = "nothing";
        echo " <div class='message'>
    $message
      </div>
      ";
    }

    if (isset($_GET['username'])) {
        $_SESSION['user'] = $_GET['username'];

        setcookie("user", $_SESSION['user'], time() + 86400);
    }

    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        setcookie("user", $_SESSION['user'], time() - 86400);

        header("Location: package.php");
    }

    ?>



    <nav>
        <h2 class="project-name">
            <span class="title">Ab</span>ugida
        </h2>

        <ul class="nav-options">
            <li class="nav-option">
                <a href="home.php">
                    Home
                </a>
            </li>
            <li class="nav-option">
                <a href="package.php">
                    Packages
                </a>
            </li>
            <li class="nav-option mypage">
                My Page
            </li>
            <li class="nav-option">
                <a href="">
                    Gallery
                </a>
            </li>
            <li class="nav-option">
                <a href="">
                    Contact Us
                </a>
            </li>
        </ul>


        <button class="search">

            <i class="fa-solid fa-magnifying-glass fa-search-nav"></i>

        </button>

        <div class="account">

            <?php
            if (isset($_SESSION['user'])) {
            ?>
                <button class="logout">
                    <a href="package.php?logout=user">
                        Logout
                    </a>
                </button>
            <?php } else { ?>
                <button class="login">Login</button>
                <button class="signup">Signup</button>
            <?php } ?>

        </div>
    </nav>


    <div class="search-bar">
        <form action="" id="search-form">
            <input type="text" name="search-input" id="search-input">
        </form>

        <button class="close">
            <i class="fa-solid fa-rectangle-xmark "></i>
        </button>
    </div>

    <div class="search-items">

    </div>


    <div class="loginpage">

        <div class="loginpagediv">



            <div class="logincontainer">

                <h2>Sign in</h2>
                <p>Login to manage your Account</p>
                <form action="Controller/login.controller.php" method="post">
                    <input type="text" name="username" id="username" placeholder="Username"><br>
                    <input type="password" name="loginpassword" id="loginpassword" placeholder="Password"><br>
                    <input type="checkbox" name="rmbr" id="rmbr"><span>Remember Me</span><br>
                    <button type="submit" class="submit" name="submit">Sign in</button>

                </form>
            </div>

        </div>
 

        <button class="show">
            Show
        </button>
        <i class="fa-solid fa-user"></i>
        <i class="fa-solid fa-unlock"></i>

        <span class="signuplink">Don't have an account <span class="signupredirect">Sign Up</span></span>

        <button class="close-login-page">
            <i class="fa-solid fa-xmark"></i>
        </button>

    </div>




    <div class="signuppage">


        <div class="signupcontainer">
            <div class="signupform">
                <h2 class="h1signup">Sign Up</h2>


                <form action="./Controller/signup.controller.php" method="POST" id="suform">

                    <label for="Name">Name</label>
                    <input type="text" id="name" name="name" value="" placeholder="     Name">

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="" required placeholder="     Email">

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="" required placeholder="      Password">

                    <label for="cpassword">Confirm Password</label>
                    <input type="password" id="cpassword" name="cpassword" value="" required placeholder="     Confirm Password">

                    <label for="number">Phone No.</label>
                    <input type="text" id="number" name="number" value="" required placeholder="     Phone No.">




                    <div>

                        <button type="submit" name="submit" id="submit">Submit</button>
                        <button type="reset" value="reset" id="reset">Reset</button>

                    </div>

                </form>




            </div>

        </div>
        <button class="close-signup-page">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>