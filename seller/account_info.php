<?php
session_start();

// Check if seller is logged in
if (!isset($_SESSION['seller_logged_in']) || !$_SESSION['seller_logged_in']) {
    // Redirect to login page
    header("Location: LoginAsSeller.php");
    exit;
}

// Include database connection
require '../server/connection.php';

// Fetch seller's information from the database
$seller_id = $_SESSION['seller_id'];
$stmt_seller_info = $conn->prepare("SELECT seller_name, store_name, seller_email, seller_password, whatsapp_number FROM sellers WHERE seller_id = ?");
$stmt_seller_info->bind_param("i", $seller_id);
$stmt_seller_info->execute();
$result_seller_info = $stmt_seller_info->get_result();

// Check if seller information is retrieved successfully
if ($result_seller_info->num_rows > 0) {
    $row = $result_seller_info->fetch_assoc();
    $seller_name = $row['seller_name'];
    $store_name = $row['store_name'];
    $seller_email = $row['seller_email'];
    $seller_password = $row['seller_password']; // Note: You might want to hide this or provide it securely
    $whatsapp_number = $row['whatsapp_number'];
} else {
    // Handle error if seller information is not found
    $seller_name = "Seller";
    $store_name = "";
    $seller_email = "";
    $seller_password = "";
    $whatsapp_number = "";
}
$successMessage = isset($_SESSION['successMessage']) ? $_SESSION['successMessage'] : '';
if (!empty($successMessage)) {
    echo '<div class="alert alert-success" role="alert">' . $successMessage . '</div>';
    unset($_SESSION['successMessage']); // Remove the message after displaying it
}

// Check for error message
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : '';
if (!empty($errorMessage)) {
    echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
    unset($_SESSION['errorMessage']); // Remove the message after displaying it
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Lebanese Local Sellers" name="keywords">
    <meta content="Lebanese Local Sellers" name="description">

    <!-- Favicon -->
    <link href="../img/Logonobackground1.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <!-- Top Navigation Links -->
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="../about.html">About</a>
                    <a class="text-body mr-3" href="/..contact.html">Contact</a>
                    <a class="text-body mr-3" href="../help.html">Help</a>
                    <a class="text-body mr-3" href="../faq.html">FAQs</a>
                </div>
            </div>
            <!-- Logout Button -->
            <div class="col-lg-6 text-right">
                <a href="../logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
        <!-- Logo and Admin Panel Title -->
        <div class="row align-items-center bg-light py-3 px-xl-5">
            <!-- Logo -->
            <div class="col-lg-4 col-6">
                <a href="#" class="text-decoration-none">
                    <img src="../img/Logonobackground1.png" alt="Logo" class="img-fluid">
                </a>                
            </div>
            <!-- Admin Panel Title -->
            <div class="col-lg-8 col-6 text-right">
                <h3 class="mb-0">Seller Panel</h3>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
</body>

</html>


<!-- Sidebar Start -->
<div class="container-fluid px-xl-5">
    <div class="row">
        <!-- Admin Use Cases Sidebar -->
        <div class="col-lg-3">
        <div class="list-group">
                <a href="seller.php" class="list-group-item list-group-item-action ">DashBoard</a>
                <a href="account_info.php" class="list-group-item list-group-item-action active">View Account Info</a>
                <a href="add_products_seller.php" class="list-group-item list-group-item-action">Add Products</a>
                <a href="view_products_seller.php" class="list-group-item list-group-item-action">View Products</a>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-lg-9">
        <div class="row">
    <div class="col-lg-12">
        <!-- Account Info Box -->
        <div class="card">
            <div class="card-header">
                Account Information
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Seller Name:</strong> <?php echo htmlspecialchars($seller_name); ?></li>
                    <li class="list-group-item"><strong>Store Name:</strong> <?php echo htmlspecialchars($store_name); ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($seller_email); ?></li>
                    <li class="list-group-item"><strong>Password:</strong> <?php echo htmlspecialchars($seller_password); ?></li>
                    <li class="list-group-item"><strong>WhatsApp Number:</strong> <?php echo htmlspecialchars($whatsapp_number); ?></li>
                </ul>
            </div>
            <div class="card-footer">
                <!-- Button to Change Account Info -->
                <a href="change_info.php" class="btn btn-primary">Change Info</a>
            </div>
        </div>
    </div>
</div>
</div>
</div></div>
</div>

<!-- Footer Start -->
<div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">Have a question or need assistance? Reach out to our dedicated support team. We're here to help you with any inquiries or concerns regarding your shopping experience. Feel free to get in touch via email or phone, and we'll ensure your e-commerce journey is smooth and enjoyable</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Lebanon, Bekaa, Chtoura</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@otlob.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+961 71 681 035</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Know More About Us</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="about.html"><i class="fa fa-angle-right mr-2"></i>About</a>
                            <a class="text-secondary mb-2" href="help.html"><i class="fa fa-angle-right mr-2"></i>Help</a>
                            <a class="text-secondary mb-2" href="faq.html"><i class="fa fa-angle-right mr-2"></i>FAQs</a>
                            <a class="text-secondary" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Get Bigger with Us </h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="LoginAsSeller.php"><i class="fa fa-angle-right mr-2"></i>Login as Seller</a>
                            <a class="text-secondary mb-2" href="signupseller.html"><i class="fa fa-angle-right mr-2"></i>Join Us</a>
                            <a class="text-secondary mb-2" href="about.html"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                            <a class="text-secondary mb-2" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Shop By Categories</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a href="electronics.php" class="text-secondary mb-2"><i class="fa fa-angle-right mr-2"></i>Electronics</a>
                            <a href="mens_fashion.php" class="text-secondary mb-2"><i class="fa fa-angle-right mr-2"></i>Men's Fashion</a>
                            <a href="womens_fashion.php" class="text-secondary mb-2"><i class="fa fa-angle-right mr-2"></i>Women's Fashion</a>
                            <a href="kids_fashion.php" class="text-secondary mb-2"><i class="fa fa-angle-right mr-2"></i>Kids's Fashion</a>
                            <a href="Home_kitchen.php" class="text-secondary mb-2"><i class="fa fa-angle-right mr-2"></i>Home & Kitchen</a>
                        </div>
                    </div>
                </div>
                <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
                    <div class="col-md-6 px-xl-0 text-center text-md-right align-items-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>