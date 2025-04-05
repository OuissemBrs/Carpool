<?php
include("connect.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $passwor = $_POST['password'];
    
        $sql = "SELECT * FROM `driver` WHERE Phone = '$phone'";
        $result = $conn->query($sql);
        if ($result->rowCount() > 0) {
            $sql = "SELECT * FROM `personne` WHERE Phone = '$phone' ";
            $result = $conn->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if ($passwor === $row['Password']) {
                $_SESSION['phone']= $phone;
                $_SESSION['driver']= 'driver';
                echo"<script>
                    window.history.back();
                </script>";
                exit();
            } else {
                echo"<script>
                    window.history.back();
                    alert('Password Incorrect');
                </script>";
                exit();
            }
        }else {
            $sql = "SELECT * FROM `personne` WHERE Phone = '$phone' ";
            $result = $conn->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
        }else {
            echo"<script>
                window.history.back();
                alert('Phone Not founded');
            </script>";
            exit();
        }
        
    
        if ($passwor === $row['Password']) {
            
            $_SESSION['phone']= $phone;
            echo"<script>
                    window.history.back();
                </script>";
            
            exit();
        } else {
            echo"<script>
                window.history.back();
                alert('Password Incorrect');
            </script>";
            exit();
        }
        }

        $sql = "SELECT * FROM `personne` WHERE Phone = '$phone' ";
        $result = $conn->query($sql);
    if ($result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
    }else {
        echo"<script>
            window.history.back();
            alert('Phone Not founded');
        </script>";
        exit();
    }
    

    if ($passwor === $row['Password']) {
        
        $_SESSION['phone']= $phone;
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo"<script>
            window.history.back();
            alert('Password Incorrect');
        </script>";
        exit();
    }
    }   
 else {
    header("Location: form.html?error=form_not_submitted");
    exit();
}
?>
