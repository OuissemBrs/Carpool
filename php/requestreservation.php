<?php

session_start();

include("../connect.php");
if(isset($_SESSION['phone'])){
    $phone = $_SESSION['phone'];
$id = $_GET['id'];
$test = "SELECT * FROM `pasjourney` WHERE ID = $id AND Phone = '$phone'";
$testres = $conn->query($test);
if ($testres->rowCount() > 0) {
    echo"<script>alert('You are already requested check your profile for more informations');
    history.go(-1);</script>";
}else {
    $sql1 = "SELECT * FROM `journey` WHERE ID = $id";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch(PDO::FETCH_ASSOC);
if($row1['Phone'] != $phone){
    if($row1['Places'] >= 1 ){
        $stmt = $conn->prepare("INSERT INTO  `pasjourney` (Phone, ID , Statu)
        VALUES ('$phone', $id ,'pending');");
        $stmt->execute();
        $places = $row1['Places'] - 1 ;
        $sql = "UPDATE  `journey` SET Places = $places WHERE id = $id";
        $conn->query($sql);
        echo"<script>alert('Your Request Has been Sent');
        history.go(-1);</script>";

    }else{
        echo"<script>alert('No Place Available At the Moment');
        history.go(-1);</script>";
    }
}else{
    echo"<script>alert('You Are the Driver LOL');
    history.go(-1);</script>";
}
}

}else{
    echo"<script>alert('Login First');
    history.go(-1);</script>";
}



