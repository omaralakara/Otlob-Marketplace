<?php
// Start or resume the session
session_start();

// Check if seller is logged in
if (!isset($_SESSION['seller_logged_in']) || !$_SESSION['seller_logged_in']) {
    // Redirect to login page
    header("Location: LoginAsSeller.php");
    exit;
}

// Include database connection
require '../server/connection.php';


// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form submission
    if (isset($_POST['confirm_delete'])) {
        // Get the product ID to be deleted
        $productId = $_POST['product_id'];

        // Delete the product
        $deleteStmt = $conn->prepare("DELETE FROM products WHERE product_id = ? AND seller_id = ?");
        $deleteStmt->bind_param("ii", $productId, $_SESSION['seller_id']);

        if ($deleteStmt->execute()) {
            $_SESSION['successMessage'] = "Product deleted successfully.";
        } else {
            $_SESSION['errorMessage'] = "Error deleting product.";
        }

        // Close the statement
        $deleteStmt->close();

        // Redirect back to the same page
        header("Location: view_products_seller.php");
        exit();
    }
}

// Fetch seller's ID from session
$sellerID = $_SESSION['seller_id'];

// Pagination setup
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch total number of products for the seller
$totalProductsQuery = $conn->query("SELECT COUNT(*) as total FROM products WHERE seller_id = $sellerID");
$totalProducts = $totalProductsQuery->fetch_assoc()['total'];
$totalPages = ceil($totalProducts / $limit);

// Fetch products for the current page for the seller
$productsQuery = $conn->query("SELECT * FROM products WHERE seller_id = $sellerID LIMIT $start, $limit");
$products = $productsQuery->fetch_all(MYSQLI_ASSOC);

// Check if the success message is set
if (isset($_SESSION['successMessage'])) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['successMessage'] . '</div>';
    // Unset the session variable to prevent it from being displayed again
    unset($_SESSION['successMessage']);
}

// Check for error message
if (isset($_SESSION['errorMessage'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['errorMessage'] . '</div>';
    unset($_SESSION['errorMessage']); // Remove the message after displaying it
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
                <h3 class="mb-0">Seller Panel</h3>
            </div>
        </div>
    </div>

<!-- Sidebar Start -->
<div class="container-fluid px-xl-5">
    <div class="row">
        <!-- Admin Use Cases Sidebar -->
        <div class="col-lg-3">
            <div class="list-group">
                <a href="seller.php" class="list-group-item list-group-item-action ">DashBoard</a>
                <a href="account_info.php" class="list-group-item list-group-item-action">View Account Info</a>
                <a href="add_products_seller.php" class="list-group-item list-group-item-action">Add Products</a>
                <a href="view_products_seller.php" class="list-group-item list-group-item-action active">View Products</a>
            </div>
        </div>
        <div class="col-lg-9">
    <h2>Product List</h2>
     <!-- Search Form -->
     <form action="search_products_seller.php" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="search_term" placeholder="Search for products">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Product Table -->
    <div class="col-lg-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Clicks</th> <!-- New column for product counter -->
                    <th>Image</th>
                    <th>Action</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch and display products based on the search query -->
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td>
                        <?php 
                            $productName = $product['product_name'];
                            echo strlen($productName) > 10 ? substr($productName, 0, 10) . "..." : $productName;
                        ?>
                    </td>                   
                    <td>
                        <?php 
                            $description = $product['description'];
                            echo strlen($description) > 10 ? substr($description, 0, 10) . "..." : $description;
                        ?>
                    </td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['category_name']; ?></td>
                    <!-- Display product counter -->
                    <td><?php echo $product['counter']; ?></td>
                    <td><img src="../img/<?php echo $product['image1']; ?>" alt="Product Image" style="max-width: 80px;"></td>
                    <td>
                        <a href="edit_product_seller.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
    <!-- Delete button with confirmation message and product name -->
    <form action="view_products_seller.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
        <button type="submit" name="confirm_delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the product <?php echo $product['product_name']; ?>?')">Delete</button>
    </form>
</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="pagination" style="margin-top: 20px;">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo ($page - 1); ?>" class="page-link">Previous</a>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="page-link <?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo ($page + 1); ?>" class="page-link">Next</a>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
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