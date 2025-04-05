<?php

session_start();

if(isset($_SESSION['phone']))
{
	unset($_SESSION['phone']);
}
if(isset($_SESSION['driver']))
{
	unset($_SESSION['driver']);
}


header("Location: {$_SERVER['HTTP_REFERER']}");