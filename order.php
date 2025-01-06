<?php
include 'config.php';
session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
    header('location:login.php');
}

$stmt = $conn->prepare("SELECT * FROM `cart` WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$cart_row_number = $stmt->rowCount();

if (isset($_POST['order_btn'])) {
    $name = htmlspecialchars($_POST['name']);
    $number = $_POST['number'];
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products = [];

    try {
        // Retrieve cart items for the user
        $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = :user_id");
        $cart_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $cart_query->execute();

        if ($cart_query->rowCount() > 0) {
            while ($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
                $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ')';
                $sub_total = ($cart_item['price'] * $cart_item['quantity']);
                $cart_total += $sub_total;
            }
        }

        $total_products = implode(' ', $cart_products);

        // Check if the order already exists
        $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = :name AND number = :number AND email = :email AND address = :address AND total_products = :total_products AND total_price = :total_price");
        $order_query->bindParam(':name', $name);
        $order_query->bindParam(':number', $number);
        $order_query->bindParam(':email', $email);
        $order_query->bindParam(':address', $address);
        $order_query->bindParam(':total_products', $total_products);
        $order_query->bindParam(':total_price', $cart_total);
        $order_query->execute();

        if ($cart_total == 0) {
            $message[] = 'Your cart is empty';
        } else {
            if ($order_query->rowCount() > 0) {
                $message[] = 'Order already placed!';
            } else {
                // Insert the new order
                $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, address, total_products, total_price, placed_on) VALUES (:user_id, :name, :number, :email, :address, :total_products, :total_price, :placed_on)");
                $insert_order->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $insert_order->bindParam(':name', $name);
                $insert_order->bindParam(':number', $number);
                $insert_order->bindParam(':email', $email);
                $insert_order->bindParam(':address', $address);
                $insert_order->bindParam(':total_products', $total_products);
                $insert_order->bindParam(':total_price', $cart_total);
                $insert_order->bindParam(':placed_on', $placed_on);
                $insert_order->execute();

                $message[] = 'Order placed successfully!';

                // Delete items from the cart after successful order placement
                $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = :user_id");
                $delete_cart->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $delete_cart->execute();
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('navbar.php'); ?>

    <section class="py-5" style="background-color: #eee;">
        <div class="container py-5 form-container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <h1 class="text-center">Place Your Order</h1>
                            <form action="" method="post" class="mt-4">
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <!-- Number -->
                                <div class="mb-3">
                                    <label for="number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="number" name="number" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                </div>

                                <!-- Total Products -->
                                <!-- <div class="mb-3">
                                    <label for="total_products" class="form-label">Total Products</label>
                                    <input type="text" class="form-control" id="total_products" name="total_products"
                                        placeholder="List of products" required>
                                </div> -->

                                <!-- Total Price -->
                                <!-- <div class="mb-3">
                                    <label for="total_price" class="form-label">Total Price</label>
                                    <input type="number" class="form-control" id="total_price" name="total_price" required>
                                </div> -->

                                <!-- Placed On -->
                                <!-- <div class="mb-3">
                                    <label for="placed_on" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="placed_on" name="placed_on" required>
                                </div> -->

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary w-40" name="order_btn" class="product_btn">Submit Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>