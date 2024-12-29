<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['productTitle'];
    $author = $_POST['productAuthor'];
    $genre = $_POST['productGenre'];
    $price = $_POST['productPrice'];
    $description = $_POST['productDescription'];

    $image = $_FILES['productImage']['name'];
    $imageTmp = $_FILES['productImage']['tmp_name'];
    $imagePath = 'uploaded_img/' . basename($image);

    if (move_uploaded_file($imageTmp, $imagePath)) {
        $query = "INSERT INTO products (title, author, genre, description, price, image) VALUES (:title, :author, :genre, :description, :price, :image)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
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
