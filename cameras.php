<?php
include('server/connection.php');

$stmt = $conn->prepare("SELECT * FROM products where type='Cameras'");

$stmt->execute();

$stmt->store_result();

// Bind result variables
$stmt->bind_result($product_id, $seller_id, $category_id, $product_name, $description, $price, $image1, $image2, $image3, $image4, $created_at, $category_name, $color1, $color2, $color3, $size1, $size2, $size3, $type, $brand, $counter);

// Fetch results
$Fetched_Products = array();
while ($stmt->fetch()) {
    $product = array(
        'product_id' => $product_id,
        'seller_id' => $seller_id,
        'category_id' => $category_id,
        'product_name' => $product_name,
        'description' => $description,
        'price' => $price,
        'image1' => $image1,
        'image2' => $image2,
        'image3' => $image3,
        'image4' => $image4,
        'created_at' => $created_at,
        'category_name' => $category_name,
        'color1' => $color1,
        'color2' => $color2,
        'color3' => $color3,
        'size1' => $size1,
        'size2' => $size2,
        'size3' => $size3,
        'type' => $type,
        'brand' => $brand,
        'counter' => $counter
    );
    $Fetched_Products[] = $product;
}


// Close statement
$stmt->close();

// Now $featured_products contains the fetched results
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
                            <a href="index.php" class="nav-item nav-link ">Home</a>
                            <a href="Electronics.php" class="nav-item nav-link active">Electronics</a>
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




    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index.html">Home</a>
                    <span class="breadcrumb-item active">Electronics</span>
                    <span class="breadcrumb-item active">Cell Phones</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->



<!-- Shop Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <!-- Shop Product Start -->
            <div class="container">
                <div class="row">
                    <?php
                    $productsPerPage = 12; // Number of products to display per page
                    $productsPerRow = 4; // Number of products to display per row
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number, default to 1 if not set

                    // Calculate the starting index of the products to display based on current page and products per page
                    $startIndex = ($currentPage - 1) * $productsPerPage;

                    // Loop through the products and display them
                    for ($i = $startIndex; $i < min($startIndex + $productsPerPage, count($Fetched_Products)); $i++) {
                        $product = $Fetched_Products[$i]; // Assuming each product is stored as an associative array

                        // Your HTML code for displaying each product item
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="img/<?php echo $product['image1'] ?>" alt="" style="width: 350px; height: 400px;">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="detail.php?product_id=<?php echo $product['product_id'];?>"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="detail.php?product_id=<?php echo $product['product_id'];?>">
                                        <?php echo strlen($product['product_name']) > 20 ? substr($product['product_name'], 0, 20) . "..." : $product['product_name']; ?>
                                    </a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5><?php echo '$' . $product['price']; ?></h5>
                                        <h6 class="text-muted ml-2"></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small>(99)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        // Check if it's time to start a new row
                        if (($i + 1) % $productsPerRow == 0) {
                            echo '</div><div class="row">';
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Pagination links -->
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php
                                $totalPages = ceil(count($Fetched_Products) / $productsPerPage); // Calculate total number of pages
                                for ($page = 1; $page <= $totalPages; $page++) {
                                    // Display pagination links
                                    ?>
                                    <li class="page-item <?php if ($currentPage == $page) echo 'active'; ?>">
                                        <a class="page-link" href="cameras.php?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
</div>
<!-- Shop End -->
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