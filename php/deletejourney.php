<?php
session_start();
$_SESSION;
include("../connect.php");
$id = $_POST['id'];
$sql1 = "SELECT * FROM `pasjourney` WHERE ID = $id";
$result1 = $conn->query($sql1);


if($result1->rowCount() > 0){
    $phone = $_SESSION['phone'];
    $sql ="UPDATE `driver` SET NbrTrajetA = NbrTrajetA + 1 WHERE Phone = '$phone'";
}
$sql = "DELETE FROM journey WHERE id = $id";
    $statement = $conn->prepare($sql);      
    $statement->execute();
    header("Location: ../driver.php"); 