<?php
session_start(); // Start the session

include('server/connection.php');

// Initialize error message variable
$error = "";

// Check connection
if (!$conn) {
    $error = "Connection failed: " . mysqli_connect_error();
}

// Check if email and password are set and not empty
if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    // Get email and password from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to check in the sellers table
    $stmt_seller = $conn->prepare("SELECT * FROM sellers WHERE seller_email = ?");
    $stmt_seller->bind_param("s", $email);
    $stmt_seller->execute();
    $result_seller = $stmt_seller->get_result();

    // Prepare SQL query to check in the admins table
    $stmt_admin = $conn->prepare("SELECT * FROM admin WHERE admin_email = ?");
    $stmt_admin->bind_param("s", $email);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    // Check if there is a match in the sellers table
    if ($result_seller->num_rows > 0) {
        $row = $result_seller->fetch_assoc();
        // Compare plain text passwords
        if ($password === $row['seller_password']) {
            // Set session variables for the seller
            $_SESSION['seller_id'] = $row['seller_id'];
            $_SESSION['seller_email'] = $row['seller_email'];
            $_SESSION['seller_logged_in'] = true;
            // Redirect to seller.php
            header("Location: seller/seller.php");
            exit();
        } else {
            // If password is incorrect, set error message
            $error = "Invalid password. Please try again.";
        }
    }
    // Check if there is a match in the admins table
    elseif ($result_admin->num_rows > 0) {
        $row = $result_admin->fetch_assoc();
        // Compare plain text passwords
        if ($password === $row['admin_password']) {
            // Set session variables for the admin
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_email'] = $row['admin_email'];
            $_SESSION['admin_logged_in'] = true; // Set admin login status
            // Redirect to admin.php (or wherever admins should be redirected)
            header("Location: admin/admin.php");
            exit();
        } else {
            // If password is incorrect, set error message
            $error = "Invalid password. Please try again.";
        }
    } else {
        // If no match found in either table, set error message
        $error = "Email not found. Please try again.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Otlob.com</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Lebanese Local Sellers" name="keywords">
    <meta content="Lebanese Local Sellers" name="description">

    <!-- Favicon -->
    <link href="img/Logonobackground1.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="about.html">About</a>
                    <a class="text-body mr-3" href="contact.html">Contact</a>
                    <a class="text-body mr-3" href="help.html">Help</a>
                    <a class="text-body mr-3" href="faq.html">FAQs</a>
                    <a class="text-body mr-3" href="LoginAsSeller.Php">Login As Seller</a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5">
            <div class="col-lg-4 col-md-4 col-6">
                <a href="index.php" class="text-decoration-none">
                    <img src="img/Logonobackground1.png" alt="Logo" width="250" height="100">
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-6 text-left d-none d-md-block">
                <form action="search.php" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search_term" placeholder="Search for products">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-4 col-12 text-right d-none d-md-block">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+961 71 681 035</h5>
            </div>
        </div>
        <div class="row bg-light py-3 px-xl-5 d-block d-md-none">
            <div class="col-12 text-left">
                <form action="search.php" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search_term" placeholder="Search for products">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <!-- Categories Section -->
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>All Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <!-- Add more categories here -->
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Electronics <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="laptops.php" class="dropdown-item">Laptops</a>
                                <a href="cell_phones.php" class="dropdown-item">Cell Phones</a>
                                <a href="cameras.php" class="dropdown-item">Cameras</a>
                                <!-- Add more electronics categories as needed -->
                            </div>
                        </div>
                        <!-- Clothing Dropdown -->
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Clothing <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="mens_tshirts.php" class="dropdown-item">Men's T-shirts</a>
                                <a href="mens_shoes.php" class="dropdown-item">Men's Shoes</a>
                                <a href="womens_tshirts.php" class="dropdown-item">Women's T-shirts</a>
                                <a href="womens_shoes.php" class="dropdown-item">Women's shoes</a>
                                <a href="kids_tshirts.php" class="dropdown-item">Kids T-shirts</a>
                                <!-- Add more clothing categories as needed -->
                            </div>
                        </div>
                        <!-- Home & Kitchen Dropdown -->
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Home & Kitchen <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="Umbrellas.php" class="dropdown-item">Umbrellas</a>
                                <!-- Add more Home & Kitchen categories as needed -->
                            </div>
                        </div>
                        <!-- Add more categories here -->
                    </div>
                </nav>
            </div>
            <!-- Main Navbar Section -->
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="Electronics.php" class="nav-item nav-link">Electronics</a>
                            <a href="mens_fashion.php" class="nav-item nav-link">Men's Fashion</a>
                            <a href="womens_fashion.php" class="nav-item nav-link">Women's Fashion</a>
                            <a href="kids_fashion.php" class="nav-item nav-link">Kids's Fashion</a>
                            <a href="Home_kitchen.php" class="nav-item nav-link">Home & Kitchen</a>
                            <a href="new_arrivals.php" class="nav-item nav-link">New Arrivals</a>
                            <!-- Add more categories here -->
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Include Bootstrap JS (necessary for dropdowns and collapses to function) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<!-- Navbar End -->
        <!-- Breadcrumb Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                        <span class="breadcrumb-item active">Login As Seller</span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->
    

    <!-- Seller Login start  -->

    <div class="container-fluid bg-light p-5">
    <div class="row justify-content-center">
    <div class="container">
    <div class="row">
        <!-- Seller Login Section -->
        <div class="col-md-6">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h2 class="card-title text-uppercase mb-0">Seller Login</h2>
                </div>
                <div class="card-body">
                    <!-- Display error message here -->
                    <?php if (!empty($error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <!-- Login form -->
                    <form action="LoginAsSeller.php" method="POST">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Your Email Address" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter Your Password" name="password" required>
                        </div>
                        <div class="mt-3">
                            <a href="contact.html">Forgot your password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Join Us Section -->
        <div class="col-md-6">
            <div class="card bg-dark text-light rounded">
                <div class="card-body p-5 text-center">
                    <h2 class="card-title text-uppercase mb-4">Join Us</h2>
                    <p class="card-text lead mb-4">Are you a seller? Join our platform and start selling your products to a wider audience.</p>
                    <a href="signupseller.html" class="btn btn-primary btn-lg">Sign Up</a>
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