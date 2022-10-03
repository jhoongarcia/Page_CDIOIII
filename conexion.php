<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "procdio";

try {
    //$conn = mysqli_connect($server,$username,$password,$database);
    $conn  = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
} catch (PDOException $e) {
    die('Connected failed: '.$e->getMessage());
}
?>