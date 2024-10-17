<?php
session_start();


// Check if seller is logged in
if (!isset($_SESSION['seller_logged_in']) || !$_SESSION['seller_logged_in']) {
    // Redirect to login page
    header("Location: LoginAsSeller.php");
    exit;
}
// Connect to the database
require '../server/connection.php';

// Get the product ID from the URL
$productID = $_GET['product_id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $productName = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $size1 = $_POST['size1'];
    $size2 = $_POST['size2'];
    $size3 = $_POST['size3'];
    $color1 = $_POST['color1'];
    $color2 = $_POST['color2'];
    $color3 = $_POST['color3'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];

    // Check if a new image is uploaded
    if ($_FILES['image1']['size'] > 0) {
        // Move the uploaded image file to a directory on the server
        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES["image1"]["name"]);
        move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file);
        $image1 = $_FILES["image1"]["name"]; // Store only the file name in the database
    } else {
        // Use the existing image
        $image1 = $product['image1'];
    }

    // Update the product information in the database
    $updateStmt = $conn->prepare("UPDATE products SET product_name =?, description =?, price =?, size1 =?, size2 =?, size3 =?, color1 =?, color2 =?, color3 =?, brand =?, type =?, image1 =? WHERE product_id =?");
    $updateStmt->bind_param("ssssssssssssi", $productName, $description, $price, $size1, $size2, $size3, $color1, $color2, $color3, $brand, $type, $image1, $productID);
    $updateStmt->execute();

    // Set success message
    $_SESSION['successMessage'] = "Product information updated successfully.";

    // Close the statement
    $updateStmt->close();

    // Redirect to the view products page
    header("Location: view_products_seller.php");
    exit();
}

// Get the product information from the database
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id =?");
$stmt->bind_param("i", $productID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Product not found, handle accordingly (e.g., redirect or display an error message)
    exit('Product not found.');
}

$product = $result->fetch_assoc();

// Close the statement
$stmt->close();

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
                <h3 class="mb-0">Seller Panel</h3>
            </div>
        </div>
    </div> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <body>
    <h2>Edit Product</h2>
    <?php if (isset($_SESSION['errorMessage'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['errorMessage']; ?>
        </div>
        <?php unset($_SESSION['errorMessage']); ?>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?product_id=<?php echo $productID; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $product['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" step="0.01" required>
        </div>
        <!-- Size fields -->
        <div class="form-group">
            <label for="size1">Size 1:</label>
            <input type="text" class="form-control" id="size1" name="size1" value="<?php echo $product['size1']; ?>">
        </div>
        <div class="form-group">
            <label for="size2">Size 2:</label>
            <input type="text" class="form-control" id="size2" name="size2" value="<?php echo $product['size2']; ?>">
        </div>
        <div class="form-group">
            <label for="size3">Size 3:</label>
            <input type="text" class="form-control" id="size3" name="size3" value="<?php echo $product['size3']; ?>">
        </div>
        <!-- Color fields -->
        <div class="form-group">
            <label for="color1">Color 1:</label>
            <input type="text" class="form-control" id="color1" name="color1" value="<?php echo $product['color1']; ?>">
        </div>
        <div class="form-group">
            <label for="color2">Color 2:</label>
            <input type="text" class="form-control" id="color2" name="color2" value="<?php echo $product['color2']; ?>">
        </div>
        <div class="form-group">
            <label for="color3">Color 3:</label>
            <input type="text" class="form-control" id="color3" name="color3" value="<?php echo $product['color3']; ?>">
        </div>
        <!-- Brand and Type fields -->
        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" class="form-control" id="brand" name="brand" value="<?php echo $product['brand']; ?>">
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" class="form-control" id="type" name="type" value="<?php echo $product['type']; ?>">
        </div>
        <!-- Image fields -->
        <div class="form-group">
            <label for="image1">Image 1:</label>
            <input type="file" class="form-control-file" id="image1" name="image1">
        </div>
        <div class="form-group">
            <label for="image1">Image 2:</label>
            <input type="file" class="form-control-file" id="image2" name="image2">
        </div>
        <div class="form-group">
            <label for="image1">Image 3:</label>
            <input type="file" class="form-control-file" id="image3" name="image3">
        </div>
        <div class="form-group">
            <label for="image1">Image 4:</label>
            <input type="file" class="form-control-file" id="image4" name="image4">
        </div>
        <input type="submit" name="edit_product" value="Update Product" class="btn btn-primary">
        
    </form>
</body>
</html>
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
