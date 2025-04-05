<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/repstyle.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/driver.css">
    <link rel="icon" href="PICS/taxi.png">
    <title>Carpool</title>
</head>
<body>
    <?php 
    session_start();
    include("connect.php");
    $_SESSION;
    if(!isset($_SESSION['phone'])){
        header("Location: Home.php");
    }
    $phone = $_SESSION['phone'];

    $sql = "SELECT * , TIMESTAMPDIFF(YEAR  ,LicenceDate , CURDATE()) AS Experience FROM `driver` WHERE Phone = '$phone'";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $sql2 = "SELECT * FROM `personne` WHERE Phone = '$phone' ";
    $result1 = $conn->query($sql2);
    $row2 = $result1->fetch(PDO::FETCH_ASSOC);
    $star = '';
    $sql3 = "SELECT * , TIMESTAMPDIFF(HOUR  ,DepH , DesH) AS timediff FROM `journey` WHERE Phone = '$phone' ";
    $result2 = $conn->query($sql3);

    for ($i = 1; $i <= $row['Evaluation']; $i++) {
        $star = ' &#9733' .  $star;
    }

    echo"
    <div id='navbar'>
    <div id='carpool'><a href='home.php'>Carpooldz</a></div>
    <div id='username'>{$row2['Name']}</div><div id='user'><img id='usericon' src='PICS/driver.png' ></div>
    <div class='dropdown'>
    <div id='buttonpic'><img src='PICS/right-arrow.png' alt=''id='arrow'></div>
    <div class='content'>
    <div class='btnremote' onclick='logout()'>logout</div>
    <div class='btnremote' onclick='mange()'>Profile</div>
    </div>
    </div>
</div>
<div id='piccont'>
    <img src='PICS/Capture.PNG' alt='' id='pic'>
</div>
<div id='main'>
    <div id='profile'>
        <div id='myprofile'>My Profile</div>
        <div id='main1'>
            <div class='main11'><div>Evaluation:</div><div id='stars'>$star</div></div>
            <div class='main11'><div>Experience:</div><div><input type='text' name='' id='experience' value='{$row['Experience']} ANS'></div></div>
            <div class='main11'><div>Driving category:</div><div><input type='text' name='' id='category' value='{$row['Category']}'></div></div>
            <div class='main11'><div>Annulation / Delay:</div><div><input type='text' name='' id='delay' value='{$row['Delay']}/10'></div></div>
            <div class='main11'><div>Contact:</div><div><input type='text' name='' id='phone' value='{$row['Phone']}' ></div></div>
            <div class='main11'><div>Certified:</div><div>{$row['Certified']}</div></div>
        </div> </div>
    <div id='journey'>
        <div id='myjourney'>My Journey</div>
        <div><button id='mybutton'>New Journey</button></div>
        <div id='journeymange'>

    ";
    if ($result2->rowCount() > 0) {
        $today_date = date("Y-m-d");
        while($row3 = $result2->fetch(PDO::FETCH_ASSOC)) {
            $ladate = date("j/n/y", strtotime($row3['Date']));
            if( $row3['Date'] >= $today_date){   
                echo"
            <div class='journeyxx'>
            <div>{$ladate}</div>
            <div>{$row3['timediff']}h</div>
            <div>{$row3['Departure']}/{$row3['Destination']}</div>
            <div><button class='blue' id='{$row3['ID']}'>Manage</button></div>
            </div>
                ";
            }else{
                echo"
            <div class='journeyxx'>
            <div>{$ladate}</div>
            <div>{$row3['timediff']}h</div>
            <div>{$row3['Departure']}/{$row3['Destination']}</div>
            <div><button id='gray'>Manage</button></div>
            </div>     
                ";
            }
            
    }}

    echo"</div></div> </div></div>
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
    <script src="SCRIPT/driver.js"></script>
    <script src="SCRIPT/script.js"></script>
</body>
</html>