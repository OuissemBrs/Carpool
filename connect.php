<?php
$servername = "localhost";
$username = "root";
$password = "Wass11dz$$23";
$dbname = "hellothere";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
}
