<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/repstyle.css">
    <link rel="stylesheet" href="CSS/Registration.css">
    <link rel="icon" href="PICS/taxi.png">
    <title>CarpoolREG</title>
</head>

<body>
    <div id="navbar">
        <div id="carpool"><a href="home.php">Carpooldz</a></div>
        <div id="user"><img id="usericon" src="PICS/user.png" alt=""></div>
    </div>
    <div id="piccont">
        <img src="PICS/Capture.PNG" alt="" id="pic">
    </div>
    <div>
        <div class="containerfo" id="containerfo">
            <form action="php/insert.php" method="post" id="Form">
                <div class="container" id="hello">
                    <div id="reg">Registration</div>
                    <div id="type">
                        Passenger<input type="radio" name="purpose" class="chekbx" value="passenger" checked="yes" required>
                        Driver<input type="radio" name="purpose" class="chekbx" value="driver" required>
                    </div>
                    <div id="create">
                        <div class="form-con" id="nom">
                            <input type="text" name="nom" id="name" required>
                            <label for="nom">Nom</label>
                        </div>
                        <div class="form-con" id="prenom">
                            <input type="text" name="phone" minlength="10" maxlength="10" id="phone" required>
                            <label for="phone">Phone</label>
                        </div>
                        <div class="form-con" id="mail">
                            <input type="email" name="mail" id="myInput" required>
                            <label for="mail">Email</label>
                        </div>
                        <?php

                        ?>
                        <div class="form-con" id="pass">
                            <input type="password" name="pass" minlength="6" required>
                            <label for="pass">Password</label>
                        </div>
                    </div>
                    <div id="sex">
                        male<input type="radio" name="sex" class="chekbx" value="male" required>
                        female<input type="radio" name="sex" class="chekbx" value="female" required>
                    </div>
                    <div id="btn">
                        <input id="btn-submit" class="subres" type="submit" value="Register">
                    </div>
                </div>
            </form>
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
    <script src="SCRIPT/register.js"></script>
    <script>
        document.getElementById('phone').addEventListener('blur', function() {
            var phone = this.value;
            if (phone !== '') {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'check_email.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var str = xhr.responseText;
                        if (str === "inuse") {
                            document.getElementById('phone').style.borderColor = 'red';
                            document.getElementById("btn-submit").disabled = true;
                        } else {
                            document.getElementById('phone').style.borderColor = 'rgb(24, 181, 209)';
                            document.getElementById("btn-submit").disabled = false;
                        }

                    }
                };

                xhr.send('phone=' + encodeURIComponent(phone));
            }
        });
    </script>
</body>

</html>