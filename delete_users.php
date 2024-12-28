<?php
include('config.php');

if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    try{
        $stmt = $conn->prepare("DELETE FROM users WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: admin_users.php");
        exit();
    } catch(PDOException $e){
        echo "Error deleting users: ".$e->getMessage();
    }
}else{
    echo "Invalid user ID.";
}

?>