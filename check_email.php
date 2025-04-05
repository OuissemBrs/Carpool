<?php
$servername = "localhost";
$username = "root";
$password = "Wass11dz$$23";
$dbname = "hellothere";

$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
    $stmt = $conn->prepare("SELECT * FROM personne WHERE Phone = '$phone'");
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "inuse";
    } else {
        echo "notinuse";
    }
}
