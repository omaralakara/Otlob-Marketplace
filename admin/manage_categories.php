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

// If add category action is triggered
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
    // Check if category name is provided
    if (empty($_POST['newCategoryName'])) {
        $_SESSION['add_category_error'] = "New category name is required.";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    $newCategoryName = $_POST['newCategoryName'];

    // Check if category already exists
    $stmt_check_category = $conn->prepare("SELECT category_id FROM categories WHERE category_name = ?");
    $stmt_check_category->bind_param("s", $newCategoryName);
    $stmt_check_category->execute();
    $stmt_check_category->store_result();

    if ($stmt_check_category->num_rows > 0) {
        $_SESSION['add_category_error'] = "Category already exists.";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    $stmt_check_category->close();

    // Prepare and bind parameters for inserting a new category
    $stmt_insert = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
    $stmt_insert->bind_param("s", $newCategoryName);

    // Execute the statement to insert a new category
    if ($stmt_insert->execute()) {
        $_SESSION['add_category_success'] = true;
        $_SESSION['add_category_message'] = "Category added successfully!";
    } else {
        $_SESSION['add_category_error'] = "Error: " . $stmt_insert->error;
    }

    // Close the statement
    $stmt_insert->close();

    // Redirect back to the same page after addition
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// If delete category action is triggered
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_category'])) {
    // Check if category ID is provided
    if (empty($_POST['deleteCategoryId'])) {
        $_SESSION['delete_category_error'] = "Category ID is required for deletion.";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    $categoryID = $_POST['deleteCategoryId'];

    // Delete associated products first
    $stmt_delete_products = $conn->prepare("DELETE FROM products WHERE category_id = ?");
    $stmt_delete_products->bind_param("i", $categoryID);
    $stmt_delete_products->execute();
    $stmt_delete_products->close();

    // Now, delete the category
    $stmt_delete_category = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
    $stmt_delete_category->bind_param("i", $categoryID);
    
    if ($stmt_delete_category->execute()) {
        $_SESSION['delete_category_success'] = true;
        $_SESSION['delete_category_message'] = "Category deleted successfully!";
    } else {
        $_SESSION['delete_category_error'] = "Error deleting category: " . $stmt_delete_category->error;
    }

    $stmt_delete_category->close();

    // Redirect back to the same page after deletion
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

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

// Check if there was a category addition success
if (isset($_SESSION['add_category_success']) && $_SESSION['add_category_success']) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['add_category_message'] . '</div>';
    unset($_SESSION['add_category_success']);
    unset($_SESSION['add_category_message']);
}

// Check if there was a category deletion success
if (isset($_SESSION['delete_category_success']) && $_SESSION['delete_category_success']) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['delete_category_message'] . '</div>';
    unset($_SESSION['delete_category_success']);
    unset($_SESSION['delete_category_message']);
}

// Check if there was a category addition error
if (isset($_SESSION['add_category_error'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['add_category_error'] . '</div>';
    unset($_SESSION['add_category_error']);
}

// Fetch categories from the database
$categories = fetchCategoriesFromDatabase($conn);
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
                <a href="add_sellers.php" class="list-group-item list-group-item-action ">Add Sellers</a>
                <a href="view_sellers.php" class="list-group-item list-group-item-action">View Sellers</a>
                <a href="add_products.php" class="list-group-item list-group-item-action">Add Products</a>
                <a href="manage_categories.php" class="list-group-item list-group-item-action active">Manage Categories</a>
                <a href="view_products.php" class="list-group-item list-group-item-action">View Products</a>
            </div>
        </div>
<!-- Main Content -->
<div class="col-lg-9">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Display existing categories in a dropdown -->
                <div class="form-group">
                    <label for="existingCategory">Existing Categories:</label>
                    <select class="form-control" id="existingCategory" name="existingCategory">
                        <option value="">View Categories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Delete Category Form -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label for="deleteCategoryId">Select Category to Delete:</label>
                        <select class="form-control" id="deleteCategoryId" name="deleteCategoryId">
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="delete_category" class="btn btn-danger">Delete Category</button>
                </form>
            </div>
            <div class="col-md-6">
                <!-- Add New Category Form -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label for="newCategoryName">New Category Name:</label>
                        <input type="text" class="form-control" id="newCategoryName" name="newCategoryName" required>
                    </div>
                    <button type="submit" name="add_category" class="btn btn-primary">Add Category</button>
                </form>
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