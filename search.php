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
<?php
// Establish database connection (replace with your database credentials)
include('server/connection.php');

// Pagination variables
$results_per_page = 8;
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
$start_index = ($page - 1) * $results_per_page;

// Process search query
$search_term = isset($_GET['search_term']) ? $_GET['search_term'] : '';

// Retrieve products from database with pagination and search term
$sql_count = "SELECT COUNT(*) AS total FROM products";
$sql = "SELECT * FROM products";
if (!empty($search_term)) {
    $sql .= " WHERE product_name LIKE '%$search_term%' OR color1 LIKE '%$search_term%' OR color2 LIKE '%$search_term%' OR color3 LIKE '%$search_term%' OR type LIKE '%$search_term%' OR category_name LIKE '%$search_term%' OR size1 LIKE '%$search_term%' OR size2 LIKE '%$search_term%' OR size3 LIKE '%$search_term%' OR brand LIKE '%$search_term%'";
    $sql_count .= " WHERE product_name LIKE '%$search_term%' OR color1 LIKE '%$search_term%' OR color2 LIKE '%$search_term%' OR color3 LIKE '%$search_term%' OR type LIKE '%$search_term%' OR category_name LIKE '%$search_term%' OR size1 LIKE '%$search_term%' OR size2 LIKE '%$search_term%' OR size3 LIKE '%$search_term%' OR brand LIKE '%$search_term%'";
}
$sql .= " LIMIT $start_index, $results_per_page";


// Execute SQL queries
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_pages = ceil($row_count["total"] / $results_per_page);

$result = $conn->query($sql);

// Display featured products
echo '<div class="row">';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Display product
        echo '<div class="col-lg-3 col-md-4 col-sm-6 pb-1">';
        echo '<div class="product-item bg-light mb-4">';
        echo '<div class="product-img position-relative overflow-hidden">';
        echo '<img class="img-fluid w-100" src="img/' . $row['image1'] . '" alt="' . $row['product_name'] . '" style="width: 350px; height: 400px;">';
        echo '<div class="product-action">';
        echo '<a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>';
        echo '<a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>';
        echo '<a class="btn btn-outline-dark btn-square" href="detail.php?product_id=' . $row['product_id'] . '"><i class="fa fa-search"></i></a>';
        echo '</div>';
        echo '</div>';
        echo '<div class="text-center py-4">';
        echo '<a class="h6 text-decoration-none text-truncate" href="detail.php?product_id=' . $row['product_id'] . '">' . (strlen($row['product_name']) > 20 ? substr($row['product_name'], 0, 20) . "..." : $row['product_name']) . '</a>';
        echo '<div class="d-flex align-items-center justify-content-center mt-2">';
        echo '<h5>$' . $row['price'] . '</h5><h6 class="text-muted ml-2"></h6>';
        echo '</div>';
        echo '<div class="d-flex align-items-center justify-content-center mb-1">';
        echo '<small class="fa fa-star text-primary mr-1"></small>';
        echo '<small class="fa fa-star text-primary mr-1"></small>';
        echo '<small class="fa fa-star text-primary mr-1"></small>';
        echo '<small class="fa fa-star text-primary mr-1"></small>';
        echo '<small class="fa fa-star text-primary mr-1"></small>';
        echo '<small>(99)</small>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

  // Pagination links
echo '<div class="col-md-12 text-center">';
echo '<ul class="pagination justify-content-center">';
for ($i = 1; $i <= $total_pages; $i++) {
    // Adjust the query string based on the presence of the search term
    $query_string = isset($_GET['search_term']) ? '&search_term=' . urlencode($_GET['search_term']) : '';
    echo '<li class="page-item"><a class="page-link" href="search.php?page=' . $i . $query_string . '">' . $i . '</a></li>';
}
echo '</ul>';
echo '</div>';
} else {
    // No results found
    echo '<div class="col-md-12 text-center"><p>No results found</p>';
    // Add button to explore latest items
    echo '<a href="new_arrivals.php" class="btn btn-primary">Explore Our Latest Items</a></div>';
}
echo '</div>';

// Close database connection
$conn->close();
?>

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