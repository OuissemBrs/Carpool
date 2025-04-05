<?php
session_start();

include("../connect.php");
$phone = $_SESSION['phone']; 
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $sql = "UPDATE personne SET Name = '$name' WHERE Phone = '$phone' ";
    $statement = $conn->prepare($sql);      
    $statement->execute();
}    

if( isset($_POST['gmail'])){
    $Gmail = $_POST['gmail'];
    $sql = "UPDATE personne SET Gmail = '$Gmail' WHERE Phone = '$phone' ";
    $statement = $conn->prepare($sql);      
    $statement->execute();
}

if(isset($_POST['Phone'])){
    $Phone = $_POST['Phone'];
    $sql2 = "SELECT * FROM `personne` WHERE Phone = '$Phone'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch(PDO::FETCH_ASSOC);
        if($row2){
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    $sql ="UPDATE `personne` SET Phone = '$Phone' WHERE Phone = '$phone'";
    $statement = $conn->prepare($sql);      
    $statement->execute();
    $_SESSION['phone'] = $Phone ;
}



header("Location: {$_SERVER['HTTP_REFERER']}");