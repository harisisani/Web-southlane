 <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>South Lane Hospital</title>
        <link rel="stylesheet" type="text/css" href="./assets/styles/bootstrap4/bootstrap.min.css">
        <link href="./assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="./assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="./assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
        <link rel="stylesheet" type="text/css" href="./assets/plugins/OwlCarousel2-2.2.1/animate.css">
        <link href="./assets/styles/MainStyle.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="./assets/styles/responsive.css">
        <footer class="footer">
            <div class="container" >
                <div class="row footer_row" style="display: none;">
                    <div class="col">
                        <div class="footer_content">
                            <div class="row">

                                <div class="col-lg-4 footer_col">

                                    <!-- Footer About -->
                                    <div class="footer_section footer_about">
                                        <div class="footer_logo_container">

                                            <div class="footer_logo_text" style="text-align:center; margin-top:-36px;">South Lane
                                                <br/>
                                                <br /><span>Animal Hospital</span></div>
                                        </div>
                                        <div class="footer_about_text" style="text-align:center;">
                                            <img style="max-height:100px;" src="./assets/images/logo.jpg" />

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-4 footer_col">
                                    <!-- Footer Contact -->
                                    <div class="footer_section footer_contact">
                                        <div class="footer_logo_text" style="text-align:center; margin-top:-36px;">OUR
                                            <br/>
                                            <br /><span> VISION</span></div>
                                        <div class="footer_contact_info" style="text-align:center;">
                                            <ul>
                                                <li>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-4 footer_col">

                                    <!-- Footer Contact -->
                                    <div class="footer_section footer_contact">
                                        <div class="footer_logo_text" style="text-align:center; margin-top:-36px;">CONTACT
                                            <br/>
                                            <br /><span> US</span></div>
                                        <div class="footer_contact_info" style="text-align:center;">
                                            <ul>
                                                <li>Email: xxxxxx@gmail.com</li>
                                                <li>Phone: +923xx-xxxxxxx</li>
                                                <li>South Lane Animal Hospital, Karachi</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row copyright_row">
                    <div class="col">
                        <div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
                            <div class="cr_text">
                                <!-- Link back to IQRA University can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> <span>All rights reserved by South Lane Animal Hospital | Project Developed by <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://harisisani.clientpoint.net/proposal/unlock-view/proposalId/592671/pin/5123" target="_blank">Haris Isani</a></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </footer>
<?php
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => $_SERVER['SERVER_NAME'].'/south-lane/api/appointment/read-today.php',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	));

	$responseAppointments = curl_exec($curl);

	curl_close($curl);
	$allAppointmentsData=json_decode($responseAppointments);

	$allAppointments='';
	foreach($allAppointmentsData as $value){
		$allAppointments.='<tr"><td>'.$value->appointment_id_unique.'</td><td>'.$value->mr_number.'</td><td class="email">'.$value->patient_name.'</td><td class="address">'.$value->owner_name.'</td><td class="notes">'.$value->contact.'</td></tr>';
	}
?>
        <button onclick="openAppointments()" type="button" id="fixedbutton" class="btn btn-primary htmlContent">Appointments&nbsp;<span class="badge badge-light"><?=count($allAppointmentsData)?></span></button>
        <style>
            #fixedbutton {
                position: fixed;
                bottom: 5px;
                right: 0px;
                border-radius: 30px;
                font-weight: bold;
                z-index: 9999 !important;
            }
        </style>
        <script src="./assets/js/jquery-3.6.0.min.js"></script>
        <script src="./assets/styles/bootstrap4/popper.js"></script>
        <script src="./assets/styles/bootstrap4/bootstrap.min.js"></script>
        <script src="./assets/plugins/greensock/TweenMax.min.js"></script>
        <script src="./assets/plugins/greensock/TimelineMax.min.js"></script>
        <script src="./assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
        <script src="./assets/plugins/greensock/animation.gsap.min.js"></script>
        <script src="./assets/plugins/greensock/ScrollToPlugin.min.js"></script>
        <script src="./assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
        <script src="./assets/plugins/easing/easing.js"></script>
        <script src="./assets/plugins/parallax-js-master/parallax.min.js"></script>
        <script src="./assets/js/custom.js"></script>
        </div>
    </body>
    </html>
<script src="./assets/libraries/jquery-1.12.3.js"></script>
<script src="./assets/libraries/jquery.dataTables.min.js"></script>
<script src="./assets/libraries/dataTables.buttons.min.js"></script>
<script src="./assets/libraries/buttons.flash.min.js"></script>
<script src="./assets/libraries/jszip.min.js"></script>
<script src="./assets/libraries/pdfmake.min.js"></script>
<script src="./assets/libraries/vfs_fonts.js"></script>
<script src="./assets/libraries/buttons.html5.min.js"></script>
<script src="./assets/libraries/buttons.print.min.js"></script>
<script src="./assets/libraries/buttons.colVis.min.js"></script>
<script src="./assets/libraries/moment.min.js"></script>
<script src="./assets/libraries/dataTables.dateTime.min.js"></script>
<?php
    $date = new DateTime("now", new DateTimeZone('Asia/Karachi') );
    $today = $date->format("Y-m-d");
?>
<script>
	var allAppointments='<table id="appointmentsTable" class="table table-bordered"><thead><tr style="background:#F60017; color:white;"><th style="vertical-align: middle;">Ap. Id</th><th style="vertical-align: middle;">MR ID</th><th style="vertical-align: middle;">Patient Name</th><th style="vertical-align: middle;">Owner Name</th><th style="vertical-align: middle;">Contact</th></tr></thead><tbody>'+'<?=$allAppointments?></tbody></table>';
	allAppointments+='<a href="./add-appointment.php" type="button" class="btn btn-info">Create a new Appointment</a>&nbsp;';
	allAppointments+='<a href="./view-appointment.php" type="button" class="btn btn-success">See All Appointments</a>';
    function openAppointments(){
		Swal.fire({
                title: 'Appointment Bookings today:</br><?= date('F d, Y',strtotime($today))?>',
                html: ""+allAppointments,
                showCloseButton: true,
                showConfirmButton:false,
                showSubmitButton: false,
			});
	}
</script>  