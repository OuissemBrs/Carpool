<?php
session_start();
$_SESSION;
    if(isset($_SESSION['phone'])){
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/repstyle.css">
    <link rel="stylesheet" href="CSS/Registration.css">
    <link rel="icon" href="PICS/taxi.png">
    <title>CarpoolLogin</title>
</head>
<body>
    <div id="navbar">
        <div id="carpool"><a href='home.php'>Carpooldz</a></div>
        <div id="user"><img id="usericon" src="PICS/user.png" alt=""></div>
    </div>
    <div id="piccont">
        <img src="PICS/Capture.PNG" alt="" id="pic">
    </div>

    <div id="login">
        <form action="login.php" method="POST">
            
                <div id="reg">Login</div>
                <div class="form-con" id="nom">
                    <input type="text" name="phone" id="" required>
                    <label for="phone">Phone</label>
                </div>
                <div class="form-con" id="pass">
                    <input type="password" name="password" id="" required>
                    <label for="password">Password</label>
                </div>
                <div id="btn">
                    <input class="subres" type="submit" value="Login">
                </div>
            
        </form>
    </div>



    <div id="bottom">
        <div class="div1">
            <h1>Contact :</h1>
            <h2>Tel: 99 99 99 99</h2>
            <h2>Mail: hellodz@gmail.com</h2>
            <h2>Adresse: Sidi Ammar Annaba 2300</h2>
        </div>
        <div>
            <h1>Quick Links :</h1>
            <h2><a href="Registration.php">Register</a></h2>
            <h2>Send a Message</h2>
            <h2>Who are we</h2>
        </div>
        <div class="div1">
            <h1>Informations :</h1>
            <h2>Our partners</h2>
            <h2>Our regional headquarters</h2>
        </div>
    </div>
</body>
</html>