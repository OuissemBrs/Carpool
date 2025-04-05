<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/repstyle.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/Registration.css">
    <link rel="stylesheet" href="CSS/login.css">
    <title>Carpool</title>
    <link rel="icon" href="PICS/taxi.png">
</head>
<body>
    <?php 
    $_SESSION;
    if(isset($_SESSION['phone'])){
        $phone = $_SESSION['phone'];
        $sql = "SELECT * FROM `personne` WHERE Phone = '$phone' ";
        $result = $conn->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if(isset($_SESSION['driver'])){
            $icon = "<a href='driver.php'><img id='usericon' src='PICS/driver.png' ></a>";
        }else{
            $icon="<img id='usericon' src='PICS/user.png' >";
        }
        echo"
        <div id='navbar'>
        <div id='carpool'>Carpooldz</div>
        <div id='username'>{$row['Name']}</div><div id='user'>$icon</div>
        <div class='dropdown'>
            <div id='buttonpic'><img src='PICS/right-arrow.png' alt=''id='arrow'></div>
            <div class='content'>
            <div class='btnremote' id='myinput' onclick='logout()'>logout</div>
            <div class='btnremote' onclick='mange()'>Profile</div>
            </div>
        </div>
        </div>
        ";
    }else{
        echo"<div id='navbar'>
        <div id='carpool'>Carpooldz</div>
        <div id='user'><img id='usericon' src='PICS/user.png' alt=''></div>
        <div class='dropdown'>
        <div id='buttonpic'><img src='PICS/right-arrow.png' alt=''id='arrow'></div>
        <div class='content'>
        <div class='btnremote' onclick='login()'>login</div>
        <div class='btnremote' onclick='register()'>Register</div>
        </div>
        </div>
    </div>
    ";

    }

    ?>
<div id="username"></div>
    <div id="piccont">
        <img src="PICS/Capture.PNG" alt="" id="pic">
    </div>
    <div id="search">
        <form  method="GET" action="search.php" id="formtosend">
            <div id="search-bar">
                <div id="serachcon">
                    <input class="searchbt" list="Places" name="depart" id="depart" placeholder="Depart" required>
                    <input class="searchbt" list="Places" id="final" name="final" placeholder="Destination" required>
                    <datalist id="Places">
                        <option value="Annaba">
                        <option value="Batna">
                        <option value="Constantine">
                        <option value="Guelma">
                        <option value="Jijel">
                        <option value="Skikda">
                        <option value="Taref">
                        <option value="Om Bwaqi">
                        </option>
                    </datalist>
                <input class="searchbt" type="text" placeholder="Date" id="date" name="date" onblur="this.type='text'" onfocus="this.type='date'" id="ladate" required >
                <input class="searchbt" list="Sits" id="clie" name="clie" placeholder="Client" required>
                </div>
                <input id="submit" type="submit" value="Search" >
                    <datalist id="Sits">
                        <option value="1">
                        <option value="2">
                        <option value="3">
                        <option value="4">
                    </option> 
                
            </div>
        </form>
    </div>
    <div id="reviews">
        <div id="fhalf">
            <div id="familyre">
                <img src="PICS/Capture3.PNG" alt=""id="familycar">
                <p id="fhtext">I have been using this website lately to transport and what i see so far is it is 
                    good but could be better and the negative thing is the website is brand new so few 
                    drivers are available and it takes quiet time to get your transport so it is still
                    good just needs sometime to get better.</p>
            </div>
            <div id="goe">
                <h1>GO Everywhere With US!</h1>
            </div>
        </div>
        <div id="shalf">
            <div></div>
            <div class="shalf">
                <img src="PICS/homme.png" alt="" id="shpic1">
                <p>
                    I was looking for a service capable of offering trips!
                </p>
            </div>
            <div class="shalf">
                <img src="PICS/femme.png" alt="" id="shpic2" >
                <p id="sp">I was looking for a service capable of offering trips from several companies!</p>
            </div>
            <div class="shalf">
                <img src="PICS/homme2.png" alt="" id="shpic3">
                <p>"was looking for a service capable of offering trips from several companies"</p>
            </div>
        </div>
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
            <?php
            if(!isset($_SESSION['phone'])){
                echo"<h2><a href='Registration.php'>Register</a></h2>";
            }else{
                echo"<h2 onclick='logoutfirst()'>Register</h2>";
            }?>
            <h2>Send a Message</h2>
            <h2>Who are we</h2>
        </div>
        <div class="div1">
            <h1>Informations :</h1>
            <h2>Our partners</h2>
            <h2>Our regional headquarters</h2>
        </div>
    </div>
    <script src="SCRIPT/script.js"></script>
</body>
</html>