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
    <link rel="stylesheet" href="CSS/passenger.css">
    <link rel="icon" href="PICS/taxi.png">
    <title>Carpool</title>
</head>
<body>
<?php
    $_SESSION;
    if(!isset($_SESSION['phone'])){
        header("Location: Home.php");
    }
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
        <div id='carpool'><a href='home.php'>Carpooldz</a></div>
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
?>
    <div id="piccont">
        <img src="PICS/Capture.PNG" alt="" id="pic">
    </div>
<?php
    echo"
    <div id='profile'>
    <div id='profil'>
        <div>My Profile</div>
        <div id='main1'>
            <div>
                <div class='main11'><div>Name:</div><div><input type='text' name='name' id='name' value='{$row['Name']}'></div></div>
                <div class='main11'><div>Email:</div><div><input type='text' name='gmail' id='gmail' value='{$row['Gmail']}'></div></div>
                <div class='main11'><div>Contact:</div><div><input type='text' name='phone' id='phone' value='{$row['Phone']}'></div></div>
            </div>
        </div>
    </div>
    ";


?>

<div id="journey">
            <div>My Journeys</div>
            <div id="table"><table>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Depart/Arrival</th>
                    <th>Status</th>
                </tr>
                <?php
                    $sql2 = "SELECT * FROM `pasjourney` WHERE Phone = '$phone' ";
                    $result2 = $conn->query($sql2);
                    
                    while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                        $sql3 = "SELECT * FROM `journey` WHERE ID = {$row2['ID']} ";
                        $result3 = $conn->query($sql3);
                        $row3 = $result3->fetch(PDO::FETCH_ASSOC);
                        $newDate = date("j/n/y", strtotime($row3['Date']));
                        echo"<tr>";
                        echo"<td>$newDate</td>";
                        $newTime = date("H", strtotime($row3['DepH']));
                        echo"<td>$newTime h</td>";
                        echo"<td>{$row3['Departure']}/{$row3['Destination']}</td>";
                        if($row2['Statu']=== 'accepted'){
                            echo"<td id='accepted'>Accepted</td>";
                        }elseif($row2['Statu']=== 'pending'){
                            echo"<td id='pending'>Pending</td>";
                        }else{
                            echo"<td id='refused'>Refused</td>";
                        }
                        echo"</tr>";
                    }
                ?>
                </table></div>
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
    <script src="SCRIPT/personne.js"></script>
</body>
</html>