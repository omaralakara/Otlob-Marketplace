<?php
session_start();

// Include database connection
require '../server/connection.php';

// Check if seller ID is provided in the URL
if (!isset($_GET['seller_id'])) {
    // Redirect or display an error message
    exit('Seller ID is missing.');
}

$sellerId = $_GET['seller_id'];

// Retrieve seller information from the database
$stmt = $conn->prepare("SELECT * FROM sellers WHERE seller_id = ?");
$stmt->bind_param("i", $sellerId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Seller not found, handle accordingly (e.g., redirect or display an error message)
    exit('Seller not found.');
}

$seller = $result->fetch_assoc();

// Close the statement
$stmt->close();

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated form data
    $sellerName = $_POST['seller_name'];
    $storeName = $_POST['store_name'];
    $sellerEmail = $_POST['seller_email'];
    $sellerPassword = $_POST['seller_password'];
    $whatsappNumber = $_POST['whatsapp_number'];

    // Update seller information in the database
    $updateStmt = $conn->prepare("UPDATE sellers SET seller_name = ?, store_name = ?, seller_email = ?, seller_password = ?, whatsapp_number = ? WHERE seller_id = ?");
    $updateStmt->bind_param("sssssi", $sellerName, $storeName, $sellerEmail, $sellerPassword, $whatsappNumber, $sellerId);

    if ($updateStmt->execute()) {
        // Set success message
        $_SESSION['successMessage'] = "Seller information updated successfully.";
    } else {
        // Display an error message
        $_SESSION['errorMessage'] = "Error updating seller information.";
    }

    // Close the statement
    $updateStmt->close();

    // Redirect to the view sellers page
    header("Location: view_sellers.php");
    exit();
}

// Close the database connection
$conn->close();
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

    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Seller</title>
    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update the seller information?");
        }
    </script>
</head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Seller</title>
    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update the seller information?");
        }
    </script>
</head>
<body>
    <h2>Edit Seller</h2>
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="seller_name">Seller Name:</label>
        <input type="text" id="seller_name" name="seller_name" value="<?php echo $seller['seller_name']; ?>"><br><br>
        
        <label for="store_name">Store Name:</label>
        <input type="text" id="store_name" name="store_name" value="<?php echo $seller['store_name']; ?>"><br><br>
        
        <label for="seller_email">Seller Email:</label>
        <input type="email" id="seller_email" name="seller_email" value="<?php echo $seller['seller_email']; ?>"><br><br>
        
        <label for="seller_password">Password:</label>
        <input type="text" id="seller_password" name="seller_password" value="<?php echo $seller['seller_password']; ?>"><br><br>
        
        <label for="whatsapp_number">WhatsApp Number:</label>
        <input type="text" id="whatsapp_number" name="whatsapp_number" value="<?php echo $seller['whatsapp_number']; ?>"><br><br>
        
        <input type="submit" value="Update Seller" class="btn btn-primary">
    </form>
</body>
</html>

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