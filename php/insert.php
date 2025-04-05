<?php



session_start();
$_SESSION;
include("../connect.php");
$name = $_POST['nom'];
$phone = $_POST['phone'];
$pass = $_POST['pass'];
$mail = $_POST['mail'];
$purpose = $_POST['purpose'];
$sex = $_POST['sex'];
$City = $_POST['city'];
$age = $_POST['Age'];
$sql = "SELECT * FROM `personne` WHERE Phone = '$phone'";
        $result = $conn->query($sql);
        if ($result->rowCount() ==  0) {
            if($purpose === 'driver'){
                $bdate = $_POST['BirthDate'];
                $edate = $_POST['LicenseDate'];
                $stmt = $conn->prepare("INSERT INTO personne (Name, Phone, Gmail, Sex, Password,BirthDate  , Adress) VALUES ('$name' , '$phone', '$mail', '$sex', '$pass' ,'$bdate', '$City' )");
                $stmt->execute();
                $stmt = $conn->prepare("INSERT INTO driver (Phone, Evaluation, Category , Delay , Certified, LicenceDate,NbrTrajetA,NbrTrajetT) VALUES ('$phone', 3  , 'car' , 5 , 'no','$edate',0,0)");
                $stmt->execute();
                $_SESSION["phone"]=$phone;
                $_SESSION["driver"]="driver";
                echo"<script>
                    alert('YOu are now registered as A driver');
                    history.go(-2);location.reload();
                </script>";
                
                
            
            }else{
                $currentDate = new DateTime();
                $currentDate->sub(new DateInterval('P' . $age . 'Y'));
                $formattedDate = $currentDate->format('Y-m-d');
                $stmt = $conn->prepare("INSERT INTO personne (Name, Phone, Gmail, Sex, Password , BirthDate , Adress) VALUES ('$name' , '$phone', '$mail', '$sex', '$pass' ,'$formattedDate', '$City' )");
                $stmt->execute();
                $_SESSION["phone"]=$phone;
                echo"<script>
                alert('YOu are now registered as A Passenger');
                history.go(-2);location.reload();
                </script>";
            }
        }else{
            echo"<script>
                alert('Phone is already in use');
                history.go(-2);location.reload();
                </script>";
        }






?>