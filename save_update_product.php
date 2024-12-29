<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['productId'];
    $title = $_POST['productTitle'];
    $author = $_POST['productAuthor'];
    $genre = $_POST['productGenre'];
    $description = $_POST['productDescription'];
    $price = $_POST['productPrice'];
    

    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['productImage']['name'];
        $imageTmp = $_FILES['productImage']['tmp_name'];
        $imagePath = 'uploads/' . basename($image);
        move_uploaded_file($imageTmp, $imagePath);
    } else {
        $imagePath = $_POST['currentImage']; 
    }

    $query = "UPDATE products SET title = :title, author = :author, genre = :genre, description = :description, price = :price, image = :image WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image', $imagePath);
    $stmt->bindParam(':id', $productId);

    if ($stmt->execute()) {
        echo "Product updated successfully!";
        header("Location: admin_products.php");
        exit;
    } else {
        echo "Error updating product.";
    }
}
