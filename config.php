<?php

$user = 'root';
$server = 'localhost';
$dbname = 'bookstore_db';
$password = '';

try{
    $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $password);
} catch (PDOException $e){
    echo "error: " . $e->getMessage();
}


?>