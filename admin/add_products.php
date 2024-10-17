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

// Fetch categories from the database
function fetchCategoriesFromDatabase($conn) {
    $categories = array();

    // Example SQL query to fetch categories (replace with your actual query)
    $sql = "SELECT * FROM categories";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }

    return $categories;
}

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set parameters from the form 
    $sellerID = $_POST['sellerID'];
    $categoryID = $_POST['categoryName']; // Assuming categoryID is posted, replace with correct name if needed
    $productName = $_POST['productName'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $categoryName = $_POST['categoryName']; // Assuming category name is posted, replace with correct name if needed
    $color1 = !empty($_POST['color1']) ? $_POST['color1'] : null; // Check if field is empty, if not, set to null
    $color2 = !empty($_POST['color2']) ? $_POST['color2'] : null;
    $color3 = !empty($_POST['color3']) ? $_POST['color3'] : null;
    $size1 = !empty($_POST['size1']) ? $_POST['size1'] : null;
    $size2 = !empty($_POST['size2']) ? $_POST['size2'] : null;
    $size3 = !empty($_POST['size3']) ? $_POST['size3'] : null;
    $type = $_POST['type'];
    $brand = $_POST['brand'];

    // Prepare and bind parameters for inserting a new product
    if (!empty($_FILES['image1']['name'])) {
        $image1 = $_FILES['image1']['name'];
        move_uploaded_file($_FILES['image1']['tmp_name'], '../img/' . $image1); // Move image to img directory
    } else {
        $image1 = null;
    }

    if (!empty($_FILES['image2']['name'])) {
        $image2 = $_FILES['image2']['name'];
        move_uploaded_file($_FILES['image2']['tmp_name'], '../img/' . $image2); // Move image to img directory
    } else {
        $image2 = null;
    }

    if (!empty($_FILES['image3']['name'])) {
        $image3 = $_FILES['image3']['name'];
        move_uploaded_file($_FILES['image3']['tmp_name'], '../img/' . $image3); // Move image to img directory
    } else {
        $image3 = null;
    }

    if (!empty($_FILES['image4']['name'])) {
        $image4 = $_FILES['image4']['name'];
        move_uploaded_file($_FILES['image4']['tmp_name'], '../img/' . $image4); // Move image to img directory
    } else {
        $image4 = null;
    }

    $stmt_insert = $conn->prepare("INSERT INTO products (seller_id, category_id, product_name, description, price, image1, image2, image3, image4, category_name, color1, color2, color3, size1, size2, size3, type, brand) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_insert->bind_param("iissssssssssssssss", $sellerID, $categoryID, $productName, $description, $price, $image1, $image2, $image3, $image4, $categoryName, $color1, $color2, $color3, $size1, $size2, $size3, $type, $brand);

    // Execute the statement to insert a new product
    if ($stmt_insert->execute()) {
        // Set a session variable to indicate success
        $_SESSION['add_product_success'] = true;
        // Set success message
        $_SESSION['add_product_message'] = "Product added successfully!";
    } else {
        // Show an error message if insertion fails
        $_SESSION['add_product_error'] = "Error: " . $stmt_insert->error;
    }

    // Close the statement
    $stmt_insert->close();

    // Redirect back to the add product page
    header("Location: add_products.php");
    exit();
}
// Check if there was an error during product addition
if (isset($_SESSION['add_product_error'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['add_product_error'] . '</div>';
    unset($_SESSION['add_product_error']);
}

// Check if the add product operation was successful
if (isset($_SESSION['add_product_success']) && $_SESSION['add_product_success']) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['add_product_message'] . '</div>';
    unset($_SESSION['add_product_success']);
    unset($_SESSION['add_product_message']);
}

// Fetch categories from the database
$categories = fetchCategoriesFromDatabase($conn);
// Fetch sellers from the database along with their names
function fetchSellersFromDatabase($conn) {
    $sellers = array();

    // SQL query to fetch sellers along with their names
    $sql = "SELECT seller_id, seller_name, store_name FROM sellers";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sellers[] = $row;
        }
    }

    return $sellers;
}
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
                <a href="add_sellers.php" class="list-group-item list-group-item-action">Add Sellers</a>
                <a href="view_sellers.php" class="list-group-item list-group-item-action">View Sellers</a>
                <a href="add_products.php" class="list-group-item list-group-item-action active ">Add Products</a>
                <a href="manage_categories.php" class="list-group-item list-group-item-action">Manage Categories</a>
                <a href="view_products.php" class="list-group-item list-group-item-action">View Products</a>
            </div>
        </div>
        <div class="col-lg-9">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <h3>Add New Product</h3>
            </div>
        </div>
        <!-- Add Product Form Goes Here -->
        <form action="add_products.php" method="POST" enctype="multipart/form-data">
            <!-- Product Information Fields -->
            <div class="form-group">
    <label for="sellerID">Store Name:</label>
    <select class="form-control" id="sellerID" name="sellerID" required>
        <!-- Fetch and display store names here -->
        <?php
        $sellers = fetchSellersFromDatabase($conn);
        foreach ($sellers as $seller) {
            echo "<option value='" . $seller['seller_id'] . "'>" . $seller['store_name'] . "</option>";
        }
        ?>
    </select>
</div>
            <div class="form-group">
                <label for="categoryName">Category Name:</label>
                <select class="form-control" id="categoryName" name="categoryName" required>
                    <!-- Fetch and display category names here -->
                    <?php
                    $categories = fetchCategoriesFromDatabase($conn);
                    foreach ($categories as $category) {
                        echo "<option value='" . $category['category_id'] . "'>" . $category['category_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" class="form-control" id="productName" name="productName" required placeholder="Iphone 15 Pro Blue">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required placeholder="Add a clear discription that shows the feature of your product "></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required placeholder="Example: 900 (don't any $ sign with the price, only add the number) ">
            </div>
            <div class="form-group">
                <label for="image1">Image 1:</label>
                <input type="file" class="form-control-file" id="image1" name="image1" required accept="img/*">
            </div>
            <div class="form-group">
                <label for="image2">Image 2:</label>
                <input type="file" class="form-control-file" id="image2" name="image2" accept="img/*">
            </div>
            <div class="form-group">
                <label for="image3">Image 3:</label>
                <input type="file" class="form-control-file" id="image3" name="image3" accept="img/*">
            </div>
            <div class="form-group">
                <label for="image4">Image 4:</label>
                <input type="file" class="form-control-file" id="image4" name="image4" accept="img/*">
            </div>
            <!-- Add more image fields if needed -->
            <!-- Additional fields such as image2, image3, etc. can be added similarly -->
            <div class="form-group">
                <label for="color1">Color 1:</label>
                <input type="text" class="form-control" id="color1" name="color1" placeholder="Leave empty if not available">
            </div>
            <div class="form-group">
                <label for="color1">Color 2:</label>
                <input type="text" class="form-control" id="color2" name="color2" placeholder="Leave empty if not available">
            </div>
            <div class="form-group">
                <label for="color1">Color 3:</label>
                <input type="text" class="form-control" id="color3" name="color3" placeholder="Leave empty if not available">
            </div>
            
            <!-- Additional fields such as color2, color3, etc. can be added similarly -->
            <div class="form-group">
    <label for="size1">Size 1:</label>
    <input type="text" class="form-control" id="size1" name="size1" placeholder="Leave empty if not available">
</div>
<div class="form-group">
    <label for="size1">Size 2:</label>
    <input type="text" class="form-control" id="size2" name="size2" placeholder="Leave empty if not available">
</div>        <div class="form-group">
    <label for="size1">Size 3:</label>
    <input type="text" class="form-control" id="size3" name="size3" placeholder="Leave empty if not available">
</div>
            <!-- Add more size fields if needed -->
            <!-- Additional fields such as size2, size3, etc. can be added similarly -->
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" class="form-control" id="type" name="type" required placeholder="Example: Cell Phones">
            </div>
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" id="brand" name="brand" required placeholder="Example: Apple">
            </div>
            <!-- Add Product Button -->
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</div></div>
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