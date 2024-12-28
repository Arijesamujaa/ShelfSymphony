<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    try {
        $stmt = $conn->prepare("SELECT payment_status FROM orders WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order) {
            $new_status = ($order['payment_status'] === 'Pending') ? 'Completed' : 'Pending';

            $update_stmt = $conn->prepare("UPDATE orders SET payment_status = :new_status WHERE id = :id");
            $update_stmt->bindParam(':new_status', $new_status);
            $update_stmt->bindParam(':id', $id);
            $update_stmt->execute();

            header("Location: admin_orders.php"); 
            exit();
        } else {
            echo "Order not found.";
        }
    } catch (PDOException $e) {
        echo "Error updating payment status: " . $e->getMessage();
    }
} else {
    echo "Invalid order ID.";
}
