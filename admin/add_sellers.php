<?php
// Start or resume the session
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    // Redirect to login page
    header("Location: LoginAsSeller.php");
    exit;
}

// Include database connection
require '../server/connection.php';

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters for email check
    $stmt_email = $conn->prepare("SELECT seller_id FROM sellers WHERE seller_email = ?");
    $stmt_email->bind_param("s", $sellerEmail);

    // Set parameters from the form
    $sellerEmail = $_POST['sellerEmail'];

    // Execute the statement for email check
    $stmt_email->execute();
    $stmt_email->store_result();

    // Check if the email already exists
    if ($stmt_email->num_rows > 0) {
        $_SESSION['add_seller_error'] = 'Email is already used. Please choose another one.';
        $stmt_email->close();
        // Redirect back to the add seller page
        header("Location: add_sellers.php");
        exit();
    }
    $stmt_email->close();

    // Prepare and bind parameters for WhatsApp number check
    $stmt_whatsapp = $conn->prepare("SELECT seller_id FROM sellers WHERE whatsapp_number = ?");
    $stmt_whatsapp->bind_param("s", $whatsappNumber);

    // Set parameters from the form
    $whatsappNumber = $_POST['whatsappNumber'];

    // Execute the statement for WhatsApp number check
    $stmt_whatsapp->execute();
    $stmt_whatsapp->store_result();

    // Check if the WhatsApp number already exists
    if ($stmt_whatsapp->num_rows > 0) {
        $_SESSION['add_seller_error'] = 'WhatsApp number is already used. Please choose another one.';
        $stmt_whatsapp->close();
        // Redirect back to the add seller page
        header("Location: add_sellers.php");
        exit();
    }
    $stmt_whatsapp->close();

    // Prepare and bind parameters for inserting a new seller
    $stmt_insert = $conn->prepare("INSERT INTO sellers (seller_name, store_name, seller_email, seller_password, whatsapp_number) VALUES (?, ?, ?, ?, ?)");
    $stmt_insert->bind_param("sssss", $sellerName, $storeName, $sellerEmail, $sellerPassword, $whatsappNumber);

    // Set parameters from the form
    $sellerName = $_POST['sellerName'];
    $storeName = $_POST['storeName'];
    $sellerEmail = $_POST['sellerEmail'];
    $sellerPassword = $_POST['sellerPassword'];
    $whatsappNumber = $_POST['whatsappNumber'];

    // Execute the statement to insert a new seller
    if ($stmt_insert->execute()) {
        // Set a session variable to indicate success
        $_SESSION['add_seller_success'] = true;
        // Set success message
        $_SESSION['add_seller_message'] = "Seller added successfully!";
    } else {
        // Show an error message if insertion fails
        $_SESSION['add_seller_error'] = "Error: " . $stmt_insert->error;
    }

    // Close the statement
    $stmt_insert->close();

    // Redirect back to the add seller page
    header("Location: add_sellers.php");
    exit();
}

// Check if there was an error during seller addition
if (isset($_SESSION['add_seller_error'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['add_seller_error'] . '</div>';
    unset($_SESSION['add_seller_error']);
}

// Check if the add seller operation was successful
if (isset($_SESSION['add_seller_success']) && $_SESSION['add_seller_success']) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['add_seller_message'] . '</div>';
    unset($_SESSION['add_seller_success']);
    unset($_SESSION['add_seller_message']);
}

// Fetch sellers from the database
function fetchSellersFromDatabase($conn) {
    $sellers = array();

    // Example SQL query to fetch sellers (replace with your actual query)
    $sql = "SELECT * FROM sellers";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sellers[] = $row;
        }
    }

    return $sellers;
}

// Fetch sellers from the database
$sellers = fetchSellersFromDatabase($conn);
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
                <h3 class="mb-0">Admin Panel</h3>
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
                <a href="admin.php" class="list-group-item list-group-item-action ">DashBoard</a>
                <a href="add_sellers.php" class="list-group-item list-group-item-action active">Add Sellers</a>
                <a href="view_sellers.php" class="list-group-item list-group-item-action">View Sellers</a>
                <a href="add_products.php" class="list-group-item list-group-item-action">Add Products</a>
                <a href="manage_categories.php" class="list-group-item list-group-item-action">Manage Categories</a>
                <a href="view_products.php" class="list-group-item list-group-item-action">View Products</a>
            </div>
        </div>
       <!-- Add Seller -->
       <div class="col-lg-9">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Add New Seller </h3>
                    </div>
                </div>
                        <!-- Add Seller Form Goes Here -->
                        <form action="add_sellers.php" method="POST">
                            <!-- Seller Information Fields -->
                            <div class="form-group">
                                <label for="sellerName">Seller Name:</label>
                                <input type="text" class="form-control" id="sellerName" name="sellerName" required>
                            </div>
                            <div class="form-group">
                                <label for="storeName">Store Name:</label>
                                <input type="text" class="form-control" id="storeName" name="storeName" required>
                            </div>
                            <div class="form-group">
                                <label for="sellerEmail">Email:</label>
                                <input type="email" class="form-control" id="sellerEmail" name="sellerEmail" required>
                            </div>
                            <div class="form-group">
                                <label for="sellerPassword">Password:</label>
                                <input type="password" class="form-control" id="sellerPassword" name="sellerPassword" required>
                            </div>
                            <div class="form-group">
                                <label for="whatsappNumber">WhatsApp Number:</label>
                                <input type="text" class="form-control" id="whatsappNumber" name="whatsappNumber" required>
                            </div>
                            <!-- Add Seller Button -->
                            <button type="submit" class="btn btn-primary">Add Seller</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar End -->
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