<?php
session_start();

include("../connect.php");
$phone = $_SESSION['phone'];

if(isset($_POST['Experience'])){
    $experience = $_POST['Experience'];
    $sql ="UPDATE `driver` SET Experience = $experience WHERE Phone = '$phone'";
    $statement = $conn->prepare($sql);      
    $statement->execute();
}  
if(isset($_POST['Category'])){
    $Category = $_POST['Category'];
    $sql ="UPDATE `driver` SET Category = '$Category' WHERE Phone = '$phone'";
    $statement = $conn->prepare($sql);      
    $statement->execute();
}  
if(isset($_POST['Delay'])){
    $Delay = $_POST['Delay'];
    $sql ="UPDATE `driver` SET Delay = $Delay WHERE Phone = '$phone'";
    $statement = $conn->prepare($sql);      
    $statement->execute();
}  
if(isset($_POST['Phone'])){
    $Phone = $_POST['Phone'];
    echo"gdsg";
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
