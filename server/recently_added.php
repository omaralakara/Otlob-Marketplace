<?php
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT 4");

$stmt->execute();

$stmt->store_result();
// Bind result variables
$stmt->bind_result($product_id, $seller_id, $category_id, $product_name, $description, $price, $image1, $image2, $image3, $image4, $created_at, $category_name, $color1, $color2, $color3, $size1, $size2, $size3, $counter, $type, $brand);

// Fetch results
$recently_added = array();
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
        'counter' => $counter,
        'type' => $type,
        'brand' => $brand
    );
    $recently_added[] = $product;
}

// Close statement
$stmt->close();

// Now $featured_products contains the fetched results
?>
