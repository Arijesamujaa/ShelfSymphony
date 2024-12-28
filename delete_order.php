<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $stmt = $conn->prepare("DELETE FROM orders WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: admin_orders.php");
        exit();
    } catch (PDOException $e) {
        echo "Error deleting order: " . $e->getMessage();
    }
} else {
    echo "Invalid order ID.";
}

?>