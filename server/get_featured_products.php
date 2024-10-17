<?php
include('connection.php');

$cacheFile = 'random_products_cache.json';

// Check if cache file exists and is not expired
if (file_exists($cacheFile) && time() - filemtime($cacheFile) < 3600) {
    // If cache exists and is not expired, retrieve products from cache
    $featured_products = json_decode(file_get_contents($cacheFile), true);
} else {
    // If cache does not exist or is expired, fetch random products from the database
    $stmt = $conn->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 4");
    $stmt->execute();
    $stmt->store_result();

    // Bind result variables
    $stmt->bind_result($product_id, $seller_id, $category_id, $product_name, $description, $price, $image1, $image2, $image3, $image4, $created_at, $category_name, $color1, $color2, $color3, $size1, $size2, $size3, $brand, $type, $counter);

    // Fetch results
    $featured_products = array();
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
            'brand' => $brand,
            'type' => $type,
            'counter' => $counter
        );
        $featured_products[] = $product;
    }

    // Close statement
    $stmt->close();

    // Store fetched products in cache
    file_put_contents($cacheFile, json_encode($featured_products));
}

// Now $featured_products contains the fetched random products
?>
