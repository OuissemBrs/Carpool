<?php
session_start();
include("../connect.php");
$_SESSION;
$phone = $_SESSION['phone'];

$Departure = $_GET['Departure'];
$Destination = $_GET['Destination'];
$Time1 = $_GET['Time1'];
$Time2 = $_GET['Time2'];
$Places = $_GET['Places'];
$Date = $_GET['Date'];
$Smoking = $_GET['Smoking'];
$Prix = $_GET['Prix'];
$Stop1 = $_GET['Stop1'];
$Stop2 = $_GET['Stop2'];
if(!(($Stop1 === null || $Stop1 === "") &&  ($Stop2 === null || $Stop2 === ""))){
    $stmt = $conn->prepare("INSERT INTO journey (Departure, Destination, DepH, DesH, Places , Date , Smoking , Prix , Phone , Stop1 ,Stop2) VALUES ('$Departure' , '$Destination', '$Time1', '$Time2', $Places ,'$Date', '$Smoking', $Prix ,'$phone','$Stop1' ,'$Stop2' )");
}elseif(!($Stop1 === null || $Stop1 === "")){
    $stmt = $conn->prepare("INSERT INTO journey (Departure, Destination, DepH, DesH, Places , Date , Smoking , Prix , Phone , Stop1 ) VALUES ('$Departure' , '$Destination', '$Time1', '$Time2', $Places ,'$Date', '$Smoking', $Prix ,'$phone','$Stop1' )");
}
elseif(!($Stop2 === null || $Stop2 === "")){
    $stmt = $conn->prepare("INSERT INTO journey (Departure, Destination, DepH, DesH, Places , Date , Smoking , Prix , Phone , Stop2 ) VALUES ('$Departure' , '$Destination', '$Time1', '$Time2', $Places ,'$Date', '$Smoking', $Prix ,'$phone','$Stop2' )");
}else{
    $stmt = $conn->prepare("INSERT INTO journey (Departure, Destination, DepH, DesH, Places , Date , Smoking , Prix , Phone) VALUES ('$Departure' , '$Destination', '$Time1', '$Time2', $Places ,'$Date', '$Smoking', $Prix ,'$phone' )");
}
$stmt->execute();
$sql ="UPDATE `driver` SET NbrTrajetT = NbrTrajetT + 1 WHERE Phone = '$phone'";
    $statement = $conn->prepare($sql);      
    $statement->execute();
header("Location: ../driver.php"); 

