<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $stmt = $conn->prepare("DELETE FROM message WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: admin_messages.php");
        exit();
    } catch (PDOException $e) {
        echo "Error deleting message: " . $e->getMessage();
    }
} else {
    echo "Invalid order ID.";
}
