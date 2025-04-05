<?php
session_start();
include("connect.php");
    $_SESSION;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/repstyle.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/journ.css">
    <link rel="stylesheet" href="CSS/Registration.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="icon" href="PICS/taxi.png">
    <title>Journey</title>
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
                 <div class='btnremote' onclick='logout()'>logout</div>
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
    <div id="piccont">
        <img src="PICS/Capture.PNG" alt="" id="pic">
    </div>
    <?php

    $idd = $_GET['id'];
    $sql = "SELECT * FROM `journey` WHERE ID = $idd";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $timestamp = strtotime($row["Date"]);
    $formattedDate = date("m/d/y", $timestamp);
    $qname = "SELECT * FROM personne WHERE Phone = '{$row['Phone']}'";
    $stmt = $conn->query($qname);
    $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
    $DepH = date("H:i", strtotime($row["DepH"]));
    $DesH = date("H:i", strtotime($row["DesH"]));
    list($hours1, $minutes1) = explode(':', $DepH);
    list($hours2, $minutes2) = explode(':', $DesH);
    $totalMinutes1 = $hours1 * 60 + $minutes1;
    $totalMinutes2 = $hours2 * 60 + $minutes2;
    $differenceMinutes = abs($totalMinutes2 - $totalMinutes1);
    $hoursDifference = floor($differenceMinutes / 60);
    $minutesDifference = $differenceMinutes % 60;
    $diff = "{$hoursDifference}:{$minutesDifference}";

    echo"<div id='main'>
    <div id='fhalf'>
        <div id='ffhalf'>
            <div id='drname'><img src='PICS/taxi.png' alt='' id='transcar'><h2>{$result2['Name']}</h2></div>
            <div id='jrd'>
                <div class='journeytxt'>Journey Details</div>
                <div class='Voyage'>
                    <div class='voyagdet'>
                        <div class='Datedepa'>
                            <div class='depfin' ><div class='depfin1'>{$DepH}</div><div class='depfin1'>$diff</div><div class='depfin1'>{$DesH}</div></div>
                            <div class='depfinb'><div id='first'><img src='PICS/minus-big-symbol.png' alt='' srcset='' class='depfinpic'></div><div id='second'><div></div><div id='black'></div><div></div></div><div id='last'><img src='PICS/minus-big-symbol.png' alt='' srcset='' class='depfinpic'></div></div>
                            <div class='depfin' ><div class='depfin2'>{$row["Departure"]}</div><div class='depfin2'>{$row["Stop1"]}<br>{$row["Stop2"]}</div><div class='depfin2'>{$row["Destination"]}</div></div>
                        </div>
                        <div class='DateJou'>{$formattedDate}</div>
                    </div>
                    <div class='iconprix'>
                        <div class='iconsopt'>";
                        $qname = "SELECT * , TIMESTAMPDIFF(YEAR  ,LicenceDate , CURDATE()) AS Experience FROM driver WHERE Phone = '{$row['Phone']}'";
                        $stmt = $conn->query($qname);
                        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
                        if($row["Smoking"] === 'no' ){
                            echo"<img class='imgopt' src='PICS/no-smoking.png' alt=''>";
                        }
                        if($result2["Certified"] === 'yes' ){
                            echo"<img src='PICS/check.png' alt='' class='imgopt'>";
                        }
                        if(!isset($row["Stop1"]) && !isset($row["Stop2"])){
                            echo"<img class='imgopt' src='PICS/envoyer.png' alt=''>";
                        }
                        echo"</div>
                        <div class='prix'>{$row["Prix"]} DA</div>
                    </div>
                </div>
            </div>
        </div>


        ";

        $star = '';
        for ($i = 1; $i <= $result2['Evaluation']; $i++) {
            $star = ' &#9733' .  $star;
        }
    echo"<div id='sfhalf'>
    <div><table>
        <tr>
            <th>Evaluation:</th>
            <th>$star</th>
        </tr>
        <tr>
            <th>Experience:</th>
            <th>{$result2['Experience']}</th>
        </tr>
        <tr>
            <th>Categorie conduite:</th>
            <th>{$result2['Category']}</th>
        </tr>
        <tr>
            <th>Annulation et retard:</th>
            <th>{$result2['Delay']}/10</th>
        </tr>
        <tr>
            <th>Contacter le conducteur:</th>
            <th>{$row['Phone']}</th>
        </tr>
    </table></div>
    <div>
        <div>
            <div class='reserve' id='$idd'>
                <button  id='$idd' class='button'  value='22'>Reservation Request</button>
            </div>
            <div id='tri'><div></div><div id='graaay'><div></div><div id='bgray'></div><div></div></div><div></div></div>
            <div>
                <button id='return' class='button' onclick='window.history.back();'>Return</button>
            </div>
        </div>
        <div></div>
    </div>
</div></div>
<div id='shalfs'>
    <div>Option:</div>
    <div>
    <div>
    ";
    if($row["Smoking"] === 'no' ){
        echo"No Smoking <br>";
    }
    if($result2["Certified"] === 'yes' ){
        echo"Conducteur Certified <br>";
    }
    if(!isset($row["Stop1"]) && !isset($row["Stop2"]) ){
        echo"Directed Road<br>";
    }
    
    echo"
    </div>
    </div>
</div>
</div>

<div>

</div>
</div>
";
    

    ?>
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
    <script src="script/journey.js"></script>
    <script src="SCRIPT/script.js"></script>
</body>
</html>