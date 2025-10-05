<?php 
include './header.php'; ?>
<title>South Lane Hospital</title>
        <div class="features">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section_title_container text-center">
                            <h2 class="section_title">Welcome:  <?=$_SESSION["user_name"]?></h2>
                            <p>Choose your selection from the below sections</p>
                        </div>
                    </div>
                </div>

                <div class="row features_row">

                    <!-- Features Item -->

                    <div class="col-lg-4 feature_col">
                       <a href="./add-patient.php">
                        <div class="feature text-center trans_400">
                            <div class="feature_icon"><img class="section-icon" src="./assets/images/create-1.png" alt=""></div>
                            <h3 class="feature_title">Add Patient & Create Receipt</h3>
                            <p>add new patients/billing details & create reciept</p>

                        </div>
                        </a>
                    </div>

                    <!-- Features Item -->

                    <!-- Features Item -->

                    <div class="col-lg-4 feature_col">
                        <a href="./view-patients.php">
                        <div class="feature text-center trans_400">
                            <div class="feature_icon"><img class="section-icon" src="./assets/images/update-2.png" alt=""></div>
                            <h3 class="feature_title">View Patients</h3>
                            <p>view/edit/delete all patients</p>
                        </div>
                        </a>
                    </div>

                    <!-- Features Item -->

                    <div class="col-lg-4 feature_col">
                        <a href="./create-patient.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/create-1.png" alt=""></div>
                                <h3 class="feature_title">Create Patient</h3>
                                <p>add new patients & save data</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 feature_col">
                        <a href="./view-receipt.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/update-2.png" alt=""></div>
                                <h3 class="feature_title">View Receipts</h3>
                                <p>view/edit/delete all receipts</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 feature_col">
                        <a href="./view-receipt-90.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/update-2.png" alt=""></div>
                                <h3 class="feature_title">View Receipts | last 90 days</h3>
                                <p>view/edit/delete all receipts from last 90 days</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 feature_col">
                        <a href="./summary.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/summary.png" alt=""></div>
                                <h3 class="feature_title">View Summary</h3>
                                <p>view summary</p>
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-4 feature_col">
                        <a href="./add-appointment.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/create-1.png" alt=""></div>
                                <h3 class="feature_title">Add Appointments</h3>
                                <p>add new appointments</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 feature_col">
                        <a href="./view-appointment.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/update-2.png" alt=""></div>
                                <h3 class="feature_title">View Appointments</h3>
                                <p>view appointments</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 feature_col">
                        <a href="./procedure.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/read-1.png" alt=""></div>
                                <h3 class="feature_title">Procedures</h3>
                                <p>add/view procedures</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 feature_col">
                        <a href="./extras.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/read-1.png" alt=""></div>
                                <h3 class="feature_title">Extras</h3>
                                <p>add/view extras</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 feature_col">
                        <a href="./add-quote.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/create-1.png" alt=""></div>
                                <h3 class="feature_title">Create Quotes</h3>
                                <p>Create a new quote only when the client requests one — do not use it for billing purposes.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 feature_col">
                        <a href="./view-quotes.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/read-1.png" alt=""></div>
                                <h3 class="feature_title">View Quotes</h3>
                                <p>View all client quote requests here.</p>
                            </div>
                        </a>
                    </div>
                   
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include './footer.php'; ?>
