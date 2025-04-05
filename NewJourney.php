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
    <link rel="stylesheet" href="CSS/NewJourney.css">
    <link rel="stylesheet" href="CSS/Registration.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="icon" href="PICS/taxi.png">
    <title>Carpool</title>
</head>
<body>
    <?php 
    $_SESSION;
        $phone = $_SESSION['phone'];
        $sql = "SELECT * FROM `personne` WHERE Phone = '$phone' ";
        $result = $conn->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo"
        <div id='navbar'>
        <div id='carpool'><a href='home.php'>Carpooldz</a></div>
        <div id='username'>{$row['Name']}</div><div id='user'><a href='driver.php'><img id='usericon' src='PICS/driver.png' ></a></div>
        <div class='dropdown'>
            <div id='buttonpic'><img src='PICS/right-arrow.png' alt=''id='arrow'></div>
            <div class='content'>
            <div class='btnremote' onclick='logout()'>logout</div>
            <div class='btnremote' onclick='mange()'>Mange</div>
            </div>
        </div>
        </div>
        ";

    ?>
<div id="piccont">
    <img src="PICS/Capture.PNG" alt="" id="pic">
</div>


<div id="form">
<div class="formm">
            <form action="php/insertjourney.php" method="get" id="Form">
                <div id="formin">
                <div id="reg">Publish a Journey</div>
                <div class="flast">
                    <div><input type="text" onblur="this.type='text'" onfocus="this.type='date'" name="Date" id="Date" placeholder="Date" required>
                    </div>
                    <div><input type="text" name="Places" id="" placeholder="Places" min="1" max="5" onblur="this.type='text'" onfocus="this.type='number'" required>
                    </div>
                </div>
                <div class="mid"><div>
                <input type="text" name="Departure" id="Departure" placeholder="Departure" list="Places" required>
                    
                </div>
                <div>
                <input type="text" name="Time1" id="Time1" placeholder="Time" onblur="this.type='text'" onfocus="this.type='time'" required>
                    
                </div>
            </div>
                <div class="mid">
                    <div>
                    <input type="text" name="Destination" id="Destination" placeholder="Destination" list="Places"required>
                    
                    </div>
                    <div>
                    <input type="text" name="Time2" id="Time2" placeholder="Time" onblur="this.type='text'" onfocus="this.type='time'" required>
                    
                    </div>      
                </div>
                <div class="flast"><div>
                <input type="text" name="Stop1" id="Stop1" placeholder="Stop1" list="Places">
                    
                </div>
                <div>
                <input type="text" name="Stop2" id="Stop2" placeholder="Stop2" list="Places">
                    
                </div>
            </div>
            <div id="btn">
                        <input class="subres" type="submit" value="Register">
                    </div>
                </div>
            </form>
        </div>
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
            <h2>Register</h2>
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
    <script src="SCRIPT/newjourney.js"></script>
</body>
</html>