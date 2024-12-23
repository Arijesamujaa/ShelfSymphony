<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $description = $_POST['productDescription'];

    $image = $_FILES['productImage']['name'];
    $imageTmp = $_FILES['productImage']['tmp_name'];
    $imagePath = 'uploaded_img/' . basename($image);

    if (move_uploaded_file($imageTmp, $imagePath)) {
        $query = "INSERT INTO products (name, price, description, image) VALUES (:name, :price, :description, :image)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $imagePath);

        if ($stmt->execute()) {
            header("Location: admin_products.php");
            exit;
        } else {
            echo "Error adding product.";
        }
    } else {
        echo "Error uploading image.";
    }
}
