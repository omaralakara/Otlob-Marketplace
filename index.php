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

</html>
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-1.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Men's Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Explore the latest trends in men's fashion.</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="mens_fashion.php">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-2.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Women's Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Celebrate style with our women's collection</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="womens_fashion.php">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Kid's Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">For the trendiest little ones, discover our kids' fashion.</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="kids_fashion.php">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/umbrellas.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Discover Our Latest </h6>
                        <h3 class="text-white mb-3">Umbrellas</h3>
                        <a href="umbrellas.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/Laptops1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Discover Our Latest</h6>
                        <h3 class="text-white mb-3">Laptops</h3>
                        <a href="Laptops.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="womens_tshirts.php">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/cat-1.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Women's T-shirts</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="cameras.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/cat-2.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Cameras</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="Men's Shoes">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/cat-3.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Men's Shoes</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="cell_phones.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/phones.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Cell Phones</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="womens_shoes.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/girls_shoes.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Women's Shoes
                            </h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="laptops.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/laptops.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Laptops</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="mens_tshirts.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/mens.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Men's T-shirts</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="Kids_tshirts.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/kids.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Kid's T-shirts</h6>
                        </div>
                    </div>
                </a>
            </div>
            </div></div>
    <!-- Categories End -->


 <!-- Featured Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
    <div class="row px-xl-5" id="featuredProducts">
        <?php
        include('server/get_featured_products.php');

        // Display 4 featured products
        foreach ($featured_products as $row) {
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                <img class="img-fluid w-100" src="img/<?php echo $row['image1'] ?>" alt="" style="width: 350px; height: 400px;">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href="detail.php?product_id=<?php echo $row['product_id'];?>"><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                <a class="h6 text-decoration-none text-truncate" href="detail.php?product_id=<?php echo $row['product_id'];?>">
    <?php echo strlen($row['product_name']) > 20 ? substr($row['product_name'], 0, 20) . "..." : $row['product_name']; ?>
</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                    <h5><?php echo '$' . $row['price']; ?></h5><h6 class="text-muted ml-2"></h6>
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
        <?php } ?>
    </div>
</div>
<!-- Featured Products End -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>            
            
   
    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="img/samsungphones.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Discover Our Latest</h6>
                        <h3 class="text-white mb-3">Phones</h3>
                        <a href="cell_phones.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="img/cameras.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Discover Our Latest</h6>
                        <h3 class="text-white mb-3">Cameras</h3>
                        <a href="cameras.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


   <!-- Cellphones collection starts -->
   <div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Cell Phones</span></h2>
    <div class="row px-xl-5" id="CellPhones">
        <?php
        include('server/cellphones.php');

        // Display 4 products
        for ($i = 0; $i < min(4, count($cellphones)); $i++) {
            $row = $cellphones[$i];
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="img/<?php echo $row['image1'] ?>" alt="" style="width: 350px; height: 400px;">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href="detail.php?product_id=<?php echo $row['product_id'];?>"><i class="fa fa-search"></i></a>                    </div>
                </div>
                <div class="text-center py-4">
                <a class="h6 text-decoration-none text-truncate" href="detail.php?product_id=<?php echo $row['product_id'];?>">
    <?php echo strlen($row['product_name']) > 20 ? substr($row['product_name'], 0, 20) . "..." : $row['product_name']; ?>
</a>                    <div class="d-flex align-items-center justify-content-center mt-2">
<h5><?php echo '$' . $row['price']; ?></h5><h6 class="text-muted ml-2"></h6>
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
        <?php } ?>
    </div>
</div>


<script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Products End -->
    <div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Our Sellers </span></h2>
    <div class="row px-xl-5" id="CellPhones">
        </div>        </div>

    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="bg-light p-4">
                        <img src="img/vendor-1.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-2.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-3.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-4.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-5.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-6.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-7.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->
<!-- Recently Added Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recently Added</span></h2>
    <div class="row px-xl-5" id="Recentlyadded">
        <?php
        include('server/recently_added.php');

        // Display 4 products
        for ($i = 0; $i < min(4, count($recently_added)); $i++) {
            $row = $recently_added[$i];
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="img/<?php echo $row['image1'] ?>" alt="" style="width: 350px; height: 400px;">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href="detail.php?product_id=<?php echo $row['product_id'];?>"><i class="fa fa-search"></i></a>                    </div>
                </div>
                <div class="text-center py-4">
                <a class="h6 text-decoration-none text-truncate" href="detail.php?product_id=<?php echo $row['product_id'];?>">
    <?php echo strlen($row['product_name']) > 20 ? substr($row['product_name'], 0, 20) . "..." : $row['product_name']; ?>
</a>                    <div class="d-flex align-items-center justify-content-center mt-2">
<h5><?php echo '$' . $row['price']; ?></h5><h6 class="text-muted ml-2"></h6>
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
        <?php } ?>
    </div>
</div>
        </div>
        </div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>



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