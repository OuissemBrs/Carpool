<?php
session_start();
    $_SESSION;
    include("connect.php");

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/repstyle.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/mangement.css">
    <link rel="icon" href="PICS/taxi.png">
    <title>Carpool</title>
</head>
<body>
    <?php
        if(isset($_POST['phone'])){
            $phone = $_POST['phone'];
        $id = $_POST['id'];
        $statu = $_POST['statu'];

        if($statu == 'accept'){
            $sql = "UPDATE pasjourney SET Statu = 'accepted' WHERE Phone = '{$phone}' AND ID = '{$id}'";
        }else{
            $sql1 = "SELECT * FROM `journey` WHERE ID = $id";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch(PDO::FETCH_ASSOC);
            $places = $row1['Places'] + 1 ;
            $sql2 = "UPDATE  `journey` SET Places = $places WHERE id = $id";
            $statement = $conn->prepare($sql2);
            $statement->execute();
            $sql = "UPDATE pasjourney SET Statu = 'rejected' WHERE Phone = '{$phone}' AND ID = '{$id}'";
        }
        
        $statement = $conn->prepare($sql);
        $statement->execute();
        }
        if(!isset($_SESSION['phone'])){
            header("Location: Home.php");
        }
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $_SESSION['currentid'] = $id  ;
        }else{
        $id = $_SESSION['currentid'];
        }
        
        $sql = "SELECT * FROM `pasjourney` WHERE ID = $id ";
        $result = $conn->query($sql);
        $row2 = $result->fetch(PDO::FETCH_ASSOC);
        $sqlna = "SELECT * FROM `journey` WHERE ID = $id ";
        $re = $conn->query($sqlna);
        $ro = $re->fetch(PDO::FETCH_ASSOC);
        $sql2 = "SELECT * FROM `personne` WHERE Phone = '{$ro['Phone']}' ";
        $result3 = $conn->query($sql2);
        $row3 = $result3->fetch(PDO::FETCH_ASSOC);
        echo"
        <div id='navbar'>
        <div id='carpool'><a href='home.php'>Carpooldz</a></div>
        <div id='username'>{$row3['Name']}</div><div id='user'><a href='driver.php'><img id='usericon' src='PICS/driver.png' ></a></div>
    </div>
    <div id='piccont'>
        <img src='PICS/Capture.PNG' alt='' id='pic'>
    </div>
    <div id='main'>
        <div id='xjourneyx'>Mange a Journey</div>
        <div id='date'>Journey:{$ro['Date']} {$ro['Departure']}/{$ro['Destination']}</div>
        <div id='persmange'>
    
        
        ";
        $sql = "SELECT *  FROM `pasjourney` WHERE ID = $id ";
        $result = $conn->query($sql);

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $qname = "SELECT * , TIMESTAMPDIFF(YEAR  ,BirthDate , CURDATE()) AS Age FROM personne WHERE Phone = '{$row['Phone']}'";
            $stmt = $conn->query($qname);
            $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row['Statu'] === 'pending'){
                    echo"
                <div id='personne' class='$id'>
                    <div class='perso'>{$result2['Name']}</div>
                    <div class='perso'>{$result2['Age']}</div>
                    <div class='perso'>{$result2['Sex']}</div>
                    <div class='perso'>{$result2['Adress']}</div>
                    <div class='buttons' id='{$row['Phone']}'><button class='btn' id='ok'>Ok</button> <button class='btn' id='no'>No</button></div>
                </div>
                ";
            }
            
            
            

        }
        echo"
        </div>
    <div id='return' class='$id'><button onclick='returnback()'>Return</button></div>
</div>
<div id='bottom'>
    <div class='div1'>
        <h1>Contact :</h1>
        <h2>Tel: 99 99 99 99</h2>
        <h2>Mail: hellodz@gmail.com</h2>
        <h2>Adresse: Sidi Ammar Annaba 2300</h2>
    </div>
    <div>
        <h1>Quick Links :</h1>";
        
        if(!isset($_SESSION['phone'])){
            echo"<h2><a href='Registration.php'>Register</a></h2>";
        }else{
            echo"<h2 onclick='logoutfirst()'>Register</h2>";
        }
        echo"<h2>Send a Message</h2>
        <h2>Who are we</h2>
    </div>
    <div class='div1'>
        <h1>Informations :</h1>
        <h2>Our partners</h2>
        <h2>Our regional headquarters</h2>
    </div>
</div>

        ";







    ?>
    <script src="SCRIPT/mange.js"></script>
</body>
</html>