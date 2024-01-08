<?php
session_start();
if(isset($_SESSION['userLog'])){
    header('location: ./dashboard.php');
}

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="keywords" content="">

    <meta name="author" content="">



    <title>CashPinas</title>

    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">


    <!-- // PLUGINS (css files) // -->

    <link href="assets/js/plugins/bootsnav_files/skins/color.css" rel="stylesheet">

    <link href="assets/js/plugins/bootsnav_files/css/animate.css" rel="stylesheet">

    <link href="assets/js/plugins/bootsnav_files/css/bootsnav.css" rel="stylesheet">

    <link href="assets/js/plugins/bootsnav_files/css/overwrite.css" rel="stylesheet">

    <link href="assets/js/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">

    <link href="assets/js/plugins/owl-carousel/owl.theme.css" rel="stylesheet">

    <link href="assets/js/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">

    <link href="assets/js/plugins/Magnific-Popup-master/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">

    <!--// ICONS //-->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--// BOOTSTRAP & Main //-->

    <link href="assets/bootstrap-3.3.7/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/css/main.css" rel="stylesheet">

</head>



<body>



    <!--======================================== 

           Preloader

    ========================================-->

    <div class="page-preloader">

        <div class="spinner">

            <div class="rect1"></div>

            <div class="rect2"></div>

            <div class="rect3"></div>

            <div class="rect4"></div>

            <div class="rect5"></div>

        </div>

    </div>

    <!--======================================== 

           Header

    ========================================-->



    <!--//** Navigation**//-->

    <nav class="navbar navbar-default navbar-fixed white no-background bootsnav navbar-scrollspy" data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">



        <div class="container">

            <!-- Start Header Navigation -->

            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">

                    <i class="fa fa-bars"></i>

                </button>

                <a class="navbar-brand" href="#brand">

                    <img src="assets/img/logo.png" class="logo" alt="logo">

                </a>

            </div>

            <!-- End Header Navigation -->



            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="navbar-menu">

                <ul class="nav navbar-nav navbar-right">

                    <li class="active scroll"><a href="#home">Home</a></li>

                    <li class="scroll"><a href="#about">About</a></li>

                    <li class="scroll"><a href="#services">Services</a></li>


                    <li class="scroll"><a href="#contact">Contact</a></li>

                    <li class="button-holder">

                        <button type="button" class="btn btn-blue navbar-btn" data-toggle="modal" data-target="#SignIn">Sign in</button>

                    </li>

                </ul>

            </div>

            <!-- /.navbar-collapse -->

        </div>

    </nav>



    <!--//** Banner**//-->

    <section id="home">

        <div class="container">

            <div class="row">

                <!-- Introduction -->

                <div class="col-md-6 caption">

                    <h2>Welcome To CashPinas</h2>

                    <h2>

                    <p>invest now and earn later, we provide good quality service for you.</p>

                </div>

                <!-- Sign Up -->

                <div class="col-md-5 col-md-offset-1">

                    <form class="signup-form" id="registerForm" >

                        <h2 class="text-center">Signup Now</h2>
                        <hr>
                        <div class="d-none" id="registerError" ></div>
                            <div class="form-group mt-1">
                                <input type="email"  class="form-control" placeholder="Email" name="emailReg" id="emailReg">
                            </div>
                            <div class="form-group mt-1">
                                <input type="text"  class="form-control" placeholder="FirstName" name="fnameReg" id="fnameReg">
                            </div>
                            <div class="form-group mt-1">
                                <input type="text"  class="form-control" placeholder="LastName" name="lnameReg" id="lnameReg">
                            </div>
                            <div class="form-group mt-1">
                                <input type="text"  class="form-control" placeholder="Phone" name="phoneReg" id="phoneReg">
                            </div>
                            <div class="form-group mt-1">
                                <input type="password" class="form-control" placeholder="Password" name="passwordReg" id="passwordReg">
                            </div>
                            <div class="form-group mt-1">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="cpasswordReg" id="cpasswordReg">
                            </div>
                            <div class="form-group mt-1">
                                <input type="hidden" readonly class="form-control" placeholder="Referral Code [Optional]" value="<?php if(isset($_GET['refcode'])) {echo $_GET['refcode'];} ?>"  name="referralReg" id="referralReg">
                            </div>

                        <div class="form-group text-center">

                            <button type="submit" class="btn btn-blue btn-block">Sign Up</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>



    <!--======================================== 

           About Us

    ========================================-->



    <section id="about" class="section-padding">

        <div class="container">

            <h2>About Us</h2>

            <p>This website is a investment platform to help people to earn money online.</p>

            <div class="row">

                <div class="col-md-4">

                    <div class="icon-box">

                        <i class="material-icons">favorite</i>

                        <h4>Simple To Use</h4>

                        <p>This website is easy to use .Friendly users.</p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="icon-box">

                        <i class="material-icons">flash_on</i>

                        <h4>Powerful</h4>

                        <p>We provide good security .</p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="icon-box">

                        <i class="material-icons">settings</i>

                        <h4>Maintenance</h4>

                        <p>We always check and maintain the website.</p>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!--======================================== 

           Story

    ========================================-->



    <section id="story">

        <div class="container-fluid">

            <div class="row">

                <!-- Img -->

                <div class="col-md-6 story-bg">

                </div>

                <!-- Story Caption -->

                <div class="col-md-6">

                    <div class="story-content">

                        <h2>Our Success Story</h2>

                        <p class="story-quote">

                            " Success is finding satisfaction in giving a little more than you take."

                        </p>

                        <div class="story-text">

                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis amet consequatur incidunt, alias odit quisquam laborum nemo nisi, vel, tempora eligendi enim voluptate accusamus libero voluptas commodi ex rerum dolorem!</p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!--======================================== 

           Services

    ========================================-->



    <section id="services" class="section-padding">

        <div class="container">

            <h2>Our Services</h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, optio.</p>

            <div class="row">

                <div class="row">

                    <div class="col-sm-6 p-2">
                        <img src="./assets/img/earn.jpg" class="shadow" alt="">
                    </div>

                    <div class="col-sm-6 p-2">
                        <img src="./assets/img/earn.jpg" class="shadow" alt="">
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!--======================================== 

           Contact

    ========================================-->



    <section id="contact" class="section-padding">

        <div class="container">

            <h2>Contact Us</h2>

            <p>Send your concern to us. </p>

        </div>

        <!-- Contact Info -->

        <div class="container contact-info">

            <div class="row">

                <div class="col-md-4">

                    <div class="icon-box">

                        <i class="material-icons">place</i>

                        <h4>Address</h4>

                        <p>Cabanatuan Ciy, Nueva Ecija</p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="icon-box">

                        <i class="material-icons">phone</i>

                        <h4>Call Us On</h4>

                        <p>+639991923622</p>

                        <p>+639991923622</p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="icon-box">

                        <i class="material-icons">email</i>

                        <h4>Email us on</h4>

                        <p>yourEmail@xyz.com</p>

                        <p>yourEmail@xyz.com</p>

                    </div>

                </div>

            </div>

        </div>


    <!--======================================== 

           Footer

    ========================================-->



    <footer>

        <div class="container">

            <div class="row">

                <div class="footer-caption">

                    <img src="assets/img/logo.png" class="img-responsive center-block" alt="logo">

                    <hr>

                    <h5 class="pull-left">CashPinas, &copy;2022 All rights reserved</h5>

                    <ul class="liste-unstyled pull-right">

                        <li><a href="#facebook"><i class="fa fa-facebook"></i></a></li>

                        <li><a href="#twitter"><i class="fa fa-twitter"></i></a></li>

                        <li><a href="#linkedin"><i class="fa fa-linkedin"></i></a></li>

                        <li><a href="#instagram"><i class="fa fa-instagram"></i></a></li>

                    </ul>

                </div>

            </div>

        </div>

    </footer>

    <!--======================================== 

           Modal

    ========================================-->

    <!-- Modal -->

    <div class="modal fade" id="SignIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title text-center" id="myModalLabel">Sign In</h4>

                </div>

                <div class="modal-body">

                    <form id="loginForm" >
                        <h5 class="fw-bolder text-left " >SIGN IN</h5><hr>
                        <div class="d-none" id="loginError" ></div>
                        <div class="form-group mt-3">
                            <input type="text"  class="form-control" placeholder="Email" name="emailLog" id="emailLog">
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" placeholder="Password" name="passwordLog" id="passwordLog">
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary w-100" type="submit">LOG IN</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="assets/bootstrap-3.3.7/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <script src="assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>

    <script src="assets/js/plugins/bootsnav_files/js/bootsnav.js"></script>

    <script src="assets/js/plugins/typed.js-master/typed.js-master/dist/typed.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js"></script>

    <script src="assets/js/plugins/Magnific-Popup-master/Magnific-Popup-master/dist/jquery.magnific-popup.js"></script>

    <script src="assets/js/main.js"></script>

    <script src="./assets/js/client.js"></script>

</body>



</html>