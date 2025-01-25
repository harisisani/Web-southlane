<?php 
include './header.php'; ?>
<title>South Lane Hospital</title>
        <div class="features">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section_title_container text-center">
                            <h2 class="section_title">Welcome to Store:  <?=$_SESSION["user_name"]?></h2>
                            <p>Choose your selection from the below sections</p>
                        </div>
                    </div>
                </div>

                <div class="row features_row">

                    <!-- Features Item -->

                    <div class="col-lg-6 feature_col">
                       <a href="./add-store-bill.php">
                        <div class="feature text-center trans_400">
                            <div class="feature_icon"><img class="section-icon" src="./assets/images/create-1.png" alt=""></div>
                            <h3 class="feature_title">Add Customer & Create Receipt</h3>
                            <p>add new customer/billing details & create reciept</p>
                        </div>
                        </a>
                    </div>

                    <div class="col-lg-6 feature_col">
                       <a href="./clear-store-pending.php">
                        <div class="feature text-center trans_400">
                            <div class="feature_icon"><img class="section-icon" src="./assets/images/create-1.png" alt=""></div>
                            <h3 class="feature_title">Add Customer & Create Receipt for Pending</h3>
                            <p>add new customer/billing details & create reciept for pending</p>
                        </div>
                        </a>
                    </div>

                    <!-- Features Item -->
                    <div class="col-lg-6 feature_col">
                        <a href="./create-patient.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/create-1.png" alt=""></div>
                                <h3 class="feature_title">Create Customer</h3>
                                <p>add a new customer & save data</p>
                            </div>
                        </a>
                    </div>

                    <!-- Features Item -->


            
                    <div class="col-lg-6 feature_col">
                        <a href="./store-view-receipt.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/update-2.png" alt=""></div>
                                <h3 class="feature_title">View Receipts</h3>
                                <p>view/edit/delete all receipts</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 feature_col">
                        <a href="./store-summary.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/summary.png" alt=""></div>
                                <h3 class="feature_title">View Summary</h3>
                                <p>view summary</p>
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-6 feature_col">
                        <a href="./vendor.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/create-1.png" alt=""></div>
                                <h3 class="feature_title">Vendors</h3>
                                <p>add/update/delete vendors, see all vendors</p>
                            </div>
                        </a>
                    </div>

                    
                    <div class="col-lg-6 feature_col">
                        <a href="./manage-vendor.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/create-1.png" alt=""></div>
                                <h3 class="feature_title">Vendors Payments</h3>
                                <p>everything related to vendor payments, invoicing</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 feature_col">
                        <a href="./store-products.php">
                            <div class="feature text-center trans_400">
                                <div class="feature_icon"><img class="section-icon" src="./assets/images/update-2.png" alt=""></div>
                                <h3 class="feature_title">Store Products</h3>
                                <p>add/update/delete store products</p>
                            </div>
                        </a>
                    </div>

                    
                    <div class="col-lg-6 feature_col">
                        <a href="./view-patients.php">
                        <div class="feature text-center trans_400">
                            <div class="feature_icon"><img class="section-icon" src="./assets/images/update-2.png" alt=""></div>
                            <h3 class="feature_title">View Customers</h3>
                            <p>view/edit/delete all customers</p>
                        </div>
                        </a>
                    </div>

                    <!-- Features Item -->
                   
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include './footer.php'; ?>
