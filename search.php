<?php
session_start();
    $_SESSION;
    include("connect.php");
    function smoking($smoke){
        if($smoke == "yes"){
            return "smoking";
        }else{
            return "";
        }
    }
    
    function certified($cert){
        if($cert == "yes"){
            return "";
        }else{
            return "nocertified";
        }
    }

    function direct($direct1,$direct2){
        if(!isset($direct1) && !isset($direct2)){
            return "";
        }else{
            return "notdirect";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/repstyle.css">
    <link rel="stylesheet" href="CSS/search.css">
    <link rel="stylesheet" href="CSS/Registration.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="icon" href="PICS/taxi.png">
    <title>Journeys</title>
</head>
<body>
    <?php

$Departure = $_GET["depart"];
$Destination = $_GET["final"];
$Places = $_GET["clie"];
$Datee = $_GET["date"];
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
    }else{
        echo"<div id='navbar'>
        <div id='carpool'><a href='home.php'>Carpooldz</a></div>
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

    } ?>

<div id='piccont'>
    <img src='PICS/Capture.PNG' alt='' id='pic'>
</div>
<div id='search'>
    <form  method='GET' action='' id="formtosend">
        <div id='search-bar'>
            <div id='serachcon'>
                <input class='searchbt' list='Places' name='depart' id='depart' placeholder='Depart' value='<?php echo$Departure;?>' required>
                <input class='searchbt' list='Places' id='final' name='final' placeholder='Destination' value='<?php echo$Destination;?>' required>
                <datalist id='Places'>
                    <option value='Annaba'>
                    <option value='Batna'>
                    <option value='Constantine'>
                    <option value='Guelma'>
                    <option value='Jijel'>
                    <option value='Skikda'>
                    <option value='Taref'>
                    <option value='Om Bwaqi'>
                </datalist>
                <input class='searchbt' type='date' placeholder='Date' id='date' name='date' value='<?php echo$Datee; ?>'  required >
                <input class='searchbt' list='Sits' id='clie' name='clie' placeholder='Client' value='<?php echo$Places; ?>' required >
            </div>
            <input id='submit' type='submit' value='Search'  onclick ='submitForm()'>
            <datalist id='Sits'>
                <option value='1'>
                <option value='2'>
                <option value='3'>
                <option value='4'>
            </datalist> 
        </div>
    </form>
</div>
<div id='result'>
    <div id='searchsetting'>
        <div class='SortBy'><div><div class='fsright'>Sort By :</div></div>
        <div class='sort'>  
            <div class='fsort'>
                <div>Lowest Price</div>
                <div>Fastest Route</div>
                <div>Early Departure</div>
            </div>
            <div class='ssort'>
                
                    <div><input type='radio' name='sortby' id='' value='Lprice' onclick="sortprice()"></div>
                    <div><input type='radio' name='sortby' id='' value='Froute' onclick="sortfast()"></div>
                <div><input type='radio' name='sortby' id='' value='Edepa' onclick="sorttime()"></div>
                
                
                
            </div>
        </div>
    </div>
    <div id='row'></div>
    <div class='SortBy' id='filter'><div><div class='fsright'>Filters :</div></div>
        <div class='sort'>      
            <div class='fsort'>
                <div>Direct Route</div>
                <div>No Smoking</div>
                <div>Certified Driver</div>
            </div>
            <div class='ssort'>
                <div><input type='checkbox' value='Droute'  class='checkbox' id="droute" onclick="clearnotdirect(this.checked)" ></div>
                <div><input type='checkbox' value='Nosmoke'  value='yes' class='checkbox' id="nosmoke" onclick="clearsmoking(this.checked)"></div>
                <div><input type='checkbox' value='Certified'  value='yes' class='checkbox' id="certified"onclick="clearnotcertified(this.checked)"></div>
            </div>
        </div>
    </div>
</div>
<div id='voyup'>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $Departure = $_GET["depart"];
                $Destination = $_GET["final"];
                $Places = $_GET["clie"];
                $Datee = $_GET["date"];
                $sql = "SELECT * FROM `journey` WHERE Departure = '$Departure' AND Destination = '$Destination' AND (Stop1 = '$Destination' OR Stop1 IS NULL OR Stop1 IS NOT NULL) AND (Stop2 = '$Destination' OR Stop2 IS NULL OR Stop2 IS NOT NULL) AND Places >= {$Places} AND Date = '$Datee' AND Date >  CURDATE()";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                 while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $qname = "SELECT * FROM personne INNER JOIN driver ON personne.Phone = driver.Phone WHERE personne.Phone = '{$row['Phone']}' AND driver.Phone = '{$row['Phone']}'";
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
                    $diff = "{$hoursDifference}:{$minutesDifference}";?>
                    <div class='Voyage <?php echo smoking($row["Smoking"]); echo" "; echo certified($result2["Certified"]); echo" "; echo direct($row["Stop1"],$row["Stop2"]); ?> ' id='<?php echo$row["ID"]; ?>'>
                        <div class='voyagdet' id='<?php echo$row["ID"]; ?>'>
                            <div class='Datedepa'>
                                <div class='depfin' ><div class='depfin1 depart'><?php echo$DepH; ?></div><div class='depfin1 diff' ><?php echo$diff; ?></div><div class='depfin1'><?php echo$DesH; ?></div></div>
                                <div class='depfinb'><div id='first'><img src='PICS/minus-big-symbol.png' alt='' srcset='' class='depfinpic'></div><div id='second'><div></div><div id='black'></div><div></div></div><div id='last'><img src='PICS/minus-big-symbol.png' alt='' srcset='' class='depfinpic'></div></div>
                                <div class='depfin' ><div class='depfin2'><?php echo$row["Departure"]; ?></div><div class='depfin2'><?php echo$row["Stop1"]; ?><br><?php echo$row["Stop2"]; ?></div><div class='depfin2'><?php echo$row["Destination"]; ?></div></div>
                            </div>
                        </div>
                        <div class='iconprix'>
                            <div id='drname'><img src='PICS/taxi.png' alt='' id='transcar'><h2><?php echo$result2['Name']; ?></h2></div>
                            <div class='prix'><?php echo$row["Prix"]; ?> DA</div>
                        </div>
                    </div>
                    
                    

                <?php  }
                } else {
                echo "0 results";
                }}
            ?>
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
    <script src="SCRIPT/scriptphp.js"></script>
    <script src="SCRIPT/script.js"></script>

</body>
</html>
