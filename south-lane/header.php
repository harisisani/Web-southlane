
<?php
    if($_SERVER['SERVER_NAME']=="localhost"){
        $_SERVER['SERVER_NAME'].="/Web-southlane/";
    }
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 
if(!isset($_SESSION["user_id"])){
    header("Location: ./login.php");
}
?>
<!DOCTYPE html>
    <html lang="en">

    <head> 
    <link rel="icon" type="image/png" href="./assets/images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="./assets/styles/bootstrap4/bootstrap.min.css">
    <link href="./assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="./assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="./assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="./assets/plugins/OwlCarousel2-2.2.1/animate.css">
    <link href="./assets/styles/MainStyle.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="./assets/styles/responsive.css">
    <link rel="stylesheet" href="./assets/libraries/m1.css" />
    <link rel="stylesheet" href="./assets/libraries/m2.css" />
    <style>
        #check {
            font-size: 18px;
            font-weight: 500;
            color: #384158;
            -webkit-transition: all 200ms ease;
            -moz-transition: all 200ms ease;
            -ms-transition: all 200ms ease;
            -o-transition: all 200ms ease;
            transition: all 200ms ease;
        }

        .logout1 {
            font-size: 18px;
            font-weight: 500;
            color: #384158;
            background: white;
            border: none;
        }

        #checker {
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            text-transform: uppercase;
            color: rgba(0, 0, 0, 1);
            font-weight: 700;
            letter-spacing: 0.1em;
            -webkit-transition: all 200ms ease;
            -moz-transition: all 200ms ease;
            -ms-transition: all 200ms ease;
            -o-transition: all 200ms ease;
            transition: all 200ms ease;
        }

        .logout2 {
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            text-transform: uppercase;
            color: rgba(0, 0, 0, 1);
            font-weight: 700;
            letter-spacing: 0.1em;
            -webkit-transition: all 200ms ease;
            -moz-transition: all 200ms ease;
            -ms-transition: all 200ms ease;
            -o-transition: all 200ms ease;
            transition: all 200ms ease;
            background: white;
            border: none;
        }

        .section-icon{
            min-height: 100px;
            max-height: 150px;
            height: 150px;
        }
    </style>
    <script src="./assets/js/JavaScript.js" type="text/javascript"></script></head>

    <body>
        <form>
            <div class="super_container">
                <!-- Header -->
                <header class="header">
                    <!-- Top Bar -->
                    <div class="top_bar">
                        <div class="top_bar_container">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                                            <ul class="top_bar_contact_list">
                                                <li>
                                                    <div class="question">Have any questions?</div>
                                                </li>
                                                <li>
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                    <div>+92313-1176092</div>
                                                </li>
                                                <li>
                                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                    <div>info@southlaneanimalhospital.com</div>
                                                </li>
                                                <li>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <div style="font-weight: bold;"><?=$_SESSION["user_name"]?></div>
                                                </li>
                                                <li>
                                                    <i class="fa fa-money" aria-hidden="true"></i>
                                                    <div style="font-weight: bold;"><a style="color: white;" href="vouchers.php">Vouchers</a></div>
                                                </li>
                                                <li>
                                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                                    <div style="font-weight: bold;"><a style="color: white;" href="logout.php">Log out</a></div>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Header Content -->

                    <div class="header_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="header_content d-flex flex-row align-items-center justify-content-start">
                                        <div class="logo_container">
                                            <a href="index.php">
                                                <div class="logo_text"><span>South Lane Animal Hospital</span></div>
                                            </a>
                                        </div>
                                        <nav class="main_nav_contaner ml-auto">
                                            <ul class="main_nav">
                                                <li><a href="create-patient.php">Add Patient</a></li>
                                                <li><a href="view-patients.php">Patient</a></li>
                                                <li><a href="view-receipt.php">Receipt</a></li>
                                                <li><a href="summary.php">Summary</a></li>
                                                <li><a href="procedure.php">Procedures</a></li>
                                                <li><a href="extras.php">Extras</a></li>
                                                <li><a href="add-patient.php">Create</a></li>
                                                <li><a href="vouchers.php">Vouchers</a></li>
                                            </ul>
                                            <!-- Hamburger -->
                                            <div class="hamburger menu_mm">
                                                <i class="fa fa-bars menu_mm" aria-hidden="true"></i>
                                            </div>
                                        </nav>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Header Search Panel -->

                </header>

                <!-- Menu -->

                <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
                    <div class="menu_close_container">
                        <div class="menu_close">
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                    <nav class="menu_nav">
                        <ul class="menu_mm">
                            <li><a href="#">User: <?=$_SESSION["user_name"]?></a></li>
                             <li><a href="index.php">Home</a></li>
                            <li><a href="add-patient.php">Add Patient</a></li>
                            <li><a href="view-patients.php">View Patient</a></li>
                            <li><a href="receipt.php">Receipt</a></li>
                            <li><a href="summary.php">Summary</a></li>
                            <li><a href="procedure.php">Procedures</a></li>
                            <li><a href="extras.php">Extras</a></li>
                            <li><a href="create-patient.php">Create</a></li>
                            <li><a href="logout.php">Log out</a></li>
                        </ul>
                    </nav>

                </div>
        </form>
    </html>
<link rel="stylesheet" href="./assets/libraries/jquery.dataTables.min.css" />
<link rel="stylesheet" href="./assets/libraries/buttons.dataTables.min.css" />
<link href="./assets/libraries/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="./assets/libraries/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="./assets/libraries/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
